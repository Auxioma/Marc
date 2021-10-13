<?php

namespace App\Controller\Users;


use App\datatrans;
use App\Entity\Adversing;
use App\Entity\Facture;
use App\Entity\PackageAdTextual;
use App\Entity\Position;
use App\Entity\TempPicture;
use App\Entity\Announcement;
use App\Form\Users\SubmitAnnouncementType;
use App\Repository\AdversingRepository;
use App\Repository\CategoryRepository;
use App\Repository\PackageAdTextualRepository;
use App\Repository\PositionRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubmitAnnouncementController extends AbstractController
{
    /**
     * @Route("/users/publier/{option}", name="users_publier", defaults={"option"=null})
     */
    public function publier(Request $request, $option): Response
    {
        return $this->render('users/publicite/index.html.twig',['option'=>$option]);
    }

    /**
     * @Route("/users/publicite", name="users_submit_publicite")
     * @throws \Exception
     */
    public function publicite(Request $request,PositionRepository $repository,AdversingRepository $adversingRepository): Response
    {
        $session = $this->get('session');
        $preBookings = $session->get('preBookings') ? $session->get('preBookings') : [];
        $positions = $repository->getPositions();
        $_positions = [];
        foreach ($positions as $position)
            $_positions[$position->getSlug()] = $position;

        $activeAds = $adversingRepository->getActiveAds();
        $unavailabeDays = Position::slugPositions;
        foreach ($unavailabeDays as &$unvail)
            $unvail =  [];

        /**
         * @var Adversing $activeAd
         */
        foreach ($activeAds as $activeAd){
            $dateDebutAd = clone $activeAd->getStartAt();
            $dateFinAd = clone $activeAd->getEndAt();
            $days = date_diff($dateDebutAd,$dateFinAd)->days;
            for($i=1;$i<=$days;$i++){
                $unavailabeDays[$activeAd->getPosition()->getSlug()][] = $dateDebutAd->format('Y-m-d');
                date_modify($dateDebutAd,'+1 day');
            }
        }
        foreach ($preBookings as $unvPre){
            $dateDebutAd = clone $unvPre['dateDebut'];
            $dateFinAd = clone $unvPre['dateFin'];
            $days = date_diff($dateDebutAd,$dateFinAd)->days;
            for($i=1;$i<=$days;$i++){
                $unavailabeDays[$unvPre['position']][] = $dateDebutAd->format('Y-m-d');
                date_modify($dateDebutAd,'+1 day');
            }
        }

        foreach ($unavailabeDays as &$unvail)
            $unvail =  implode(',', $unvail);


        if ($request->isMethod("POST")){
            $positionSlug = $request->request->get('position');
            $dates = $request->request->get('daterange');
            if ($positionSlug and $dates){
                $positionFound = $repository->findOneBy(['slug' => $positionSlug]);
                $dates = explode(" - ",$dates);
                $dateDebut = $dates[0];
                $dateFin = $dates[1];
                $uuid = uniqid();
                $days = date_diff(new \DateTime($dateDebut),new  \DateTime($dateFin))->days;
                $preBooking = [
                    'uuid' => $uuid,
                    'dateDebut' => new \DateTime($dateDebut),
                    'dateFin' => new  \DateTime($dateFin),
                    'position' => $positionSlug,
                    'prixPerDay' => $positionFound->getPrix(),
                    'total' => $positionFound->getPrix() * $days
                ];
                $preBookings[$uuid] = $preBooking;
                $session->set('preBookings',$preBookings);
            }
            return $this->redirectToRoute('users_submit_publicite');
        }

        $total = 0;
        foreach ($preBookings as $p){
            $total = $total + $p['total'];
        }

        return $this->render('users/publicite/publicite.html.twig',[
            'positions' => $_positions,
            'preBookings' => $preBookings,
            'total' => $total,
            'unavailabeDays'=>$unavailabeDays
        ]);
    }


    /**
     * @Route("/booking/proceed", name="booking_proceed")
     */
    public function bookingProceed(Request $request,PositionRepository $positionRepository,datatrans $datatrans): Response
    {
        if ($request->isMethod("POST")){
            $session = $this->get('session');
            $preBookings = $session->get('preBookings');
            foreach ($preBookings as $key => &$booking){
                $booking['link'] = $request->request->get('link'.$key);
                $booking['base64'] = $request->request->get('base64_'.$key);
            }

            $totalBooking = 0;
            $arrayPub = [];
            $all_pubs = "";
            $em = $this->getDoctrine()->getManager();
            // Save pubs
            foreach ($preBookings as $preBooking){
                $position = $positionRepository->findOneBy(['slug'=>$preBooking['position']]);
                $publicite = new Adversing();
                $publicite->setCreatedAt(new \DateTime());
                $publicite->setPosition($position);
                $publicite->setUrl($preBooking['link']);
                $publicite->setIsValid(false);
                $publicite->setStartAt($preBooking['dateDebut']);
                $publicite->setEndAt($preBooking['dateFin']);
                $filename = self::uploadImageBase64($preBooking['base64']);
                $publicite->setPicture($filename);
                $publicite->setMontantTotal($preBooking['total']);
                $publicite->setUuid($preBooking['uuid']);
                $arrayPub[] = $preBooking['uuid'];
                $em->persist($publicite);
                $totalBooking = $totalBooking + $preBooking['total'];

            }
            $em->flush();

            foreach ($arrayPub as $item){
                $savedPub = $em->getRepository(Adversing::class)->findOneBy(['uuid' => $item]);
                $all_pubs .= $savedPub->getId().'_';
            }

            $successPath = "https://zimboo.ch/paiement/success?type=publicite&pubId=".$all_pubs;
            $cancelPath = "https://zimboo.ch/paiement/error?type=publicite&pubId=".$all_pubs;
            $errorPath = "https://zimboo.ch/paiement/cancel?type=publicite&pubId=".$all_pubs;

            $montant = $totalBooking*100;
            $response = $datatrans->CreateTransaction("zimboo-".$all_pubs,$montant,$successPath,$cancelPath,$errorPath);

            if(isset($response['error'])){
                dd($response);
                dd('error');
            }else{
                $transactionId = $response['transactionId'];
                $session->set('preBookings',[]);
                return new RedirectResponse($datatrans::payUrl.$transactionId);
            }

        }
        return $this->redirectToRoute("users_submit_publicite");
    }


    /**
     * @Route("/users/book/removeItem/{uuid}", name="users_book_removeItem")
     */
    public function removeBookItem(Request $request, $uuid): Response
    {
        $session = $this->get('session');
        $preBookings = $session->get('preBookings');
        if ($preBookings and isset($preBookings[$uuid])){
            unset($preBookings[$uuid]);
            $session->set('preBookings',$preBookings);
        }
        return $this->redirectToRoute('users_submit_publicite');
    }

    /**
     * @Route("/users/publicite-category", name="users_submit_publicite_category")
     */
    public function publiciteCategorie(Request $request): Response
    {

        return $this->render('users/publicite/publiciteCategory.html.twig');
    }




    /**
     * @Route("/users/submit/announcement", name="users_submit_announcement")
     */
    public function index(Request $request): Response
    {
        $Announcement = new Announcement();
        $form = $this->createForm(SubmitAnnouncementType::class, $Announcement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($Announcement->getPicture() as $k => $pic){
                $base = $pic->getImgBase64();
                if ($base){
                    $name = self::uploadImageBase64($base);
                    $pic->setName($name);
                    $pic->setAlt('annonce');
                }
            }
            $Announcement->setCreatedAt(new \DateTime());
            $Announcement->setUsers($this->getUser());
            $this->getDoctrine()->getManager()->persist($Announcement);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_submit_announcement_finalStep',['id'=>$Announcement->getId()]);
        }

        return $this->render('users/submit_announcement/index.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/announcement/finalStep/{id}", name="users_submit_announcement_finalStep")
     */
    public function finalStep(Request $request,PackageAdTextualRepository $repPack,datatrans $datatrans,$id)
    {

        $Announcement = $this->getDoctrine()->getManager()->getRepository(Announcement::class)->find($id);
        if ($request->isMethod('POST')){

            $proceedPaiment = false;
            if (isset($_POST['GOLD'])) {
                $pack = $repPack->findOneBy(['id'=>$request->request->get('packGold')]);
                $Announcement->setMontantTotal($pack->getNbrDays()*$pack->getPricePerDay());
                $Announcement->setPackageAdTextual($pack);
                $Announcement->setOptions(1);
                $proceedPaiment = true;
            }
            if (isset($_POST['PREMIUM'])) {
                $pack = $repPack->findOneBy(['id'=>$request->request->get('packPremium')]);
                $Announcement->setMontantTotal($pack->getNbrDays()*$pack->getPricePerDay());
                $Announcement->setPackageAdTextual($pack);
                $Announcement->setOptions(2);
                $proceedPaiment = true;

            }
            if (isset($_POST['SILVER'])) {
                $pack = $repPack->findOneBy(['id'=>$request->request->get('packSILVER')]);
                $Announcement->setMontantTotal($pack->getNbrDays()*$pack->getPricePerDay());
                $Announcement->setPackageAdTextual($pack);
                $Announcement->setOptions(2);
                $proceedPaiment = true;
            }
            if (!isset($_POST['PREMIUM']) and !isset($_POST['GOLD']) and !isset($_POST['SILVER'])){
                $Announcement->setIsPaid(true);
                $Announcement->setMontantTotal(0);
            }
            if ($proceedPaiment){

                $successPath = "https://zimboo.ch/paiement/success?type=annonce&annonceId=".$Announcement->getId();
                $cancelPath = "https://zimboo.ch/paiement/error?type=annonce&annonceId=".$Announcement->getId();
                $errorPath = "https://zimboo.ch/paiement/cancel?type=annonce&annonceId=".$Announcement->getId();

                $montant = $Announcement->getMontantTotal()*100;
                $response = $datatrans->CreateTransaction("zimboo-".$Announcement->getId(),$montant,$successPath,$cancelPath,$errorPath);

                if(isset($response['error'])){
                    dd('error');
                }else{
                   $transactionId = $response['transactionId'];
                   return new RedirectResponse($datatrans::payUrl.$transactionId);
                }

            }

            return  $this->redirectToRoute('users_my_history');
        }

        $packsPremium = $repPack->findBytypeAsc(1);
        $packsGold = $repPack->findBytypeAsc(2);
        $packsSilver = $repPack->findBytypeAsc(3);

        $previous = null;
        foreach ($packsGold as $p){
            if($previous){
                $percent = (($previous - $p->getPricePerDay()) / $previous) * 100;
                $p->setPercentTemporaire(round($percent));
            }else
                $previous = $p->getPricePerDay();
        }
        $previous = null;
        foreach ($packsPremium as $p){
            if($previous){
                $percent = (($previous - $p->getPricePerDay()) / $previous) * 100;
                $p->setPercentTemporaire(round($percent));
            }else
                $previous = $p->getPricePerDay();
        }
        $previous = null;
        foreach ($packsSilver as $p){
            if($previous){
                $percent = (($previous - $p->getPricePerDay()) / $previous) * 100;
                $p->setPercentTemporaire(round($percent));
            }else
                $previous = $p->getPricePerDay();
        }


        return $this->render('users/submit_announcement/finalStep.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'Announcement' => $Announcement,
            'packsGold' => $packsGold,
            'packsPremium' => $packsPremium,
            'packsSilver' => $packsSilver,
            'minGP' => $packsGold[0] ?? null,
            'minPP' => $packsPremium[0] ?? null,
            'minSP' => $packsSilver[0] ?? null,
        ]);
    }

    /**
     * @Route("/paiement/success", name="users_submit_announcement_success")
     */
    public function paiement_success(Request $request): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            if ($request->get('type') == 'annonce'){
                $id = $request->get('annonceId');
                $Announcement = $em->getRepository(Announcement::class)->find($id);
                $Announcement->setIsPaid(true);
                $facture = new Facture();
                $facture->setAnnonce($Announcement);
                $facture->setClient($this->getUser());
                $facture->setCreatedAt(new \DateTimeImmutable());
                $facture->setMontant($Announcement->getMontantTotal());
                $facture->setDatatransID($request->get('datatransTrxId'));
                $em->persist($facture);
            }
            if ($request->get('type') == 'publicite'){
                $pubId = $request->get('pubId');
                $ids = explode('_',$pubId);
                $facture = new Facture();
                $facture->setClient($this->getUser());
                $facture->setCreatedAt(new \DateTimeImmutable());
                $facture->setDatatransID($request->get('datatransTrxId'));

                $total = 0;
                foreach ($ids as $id){
                    $pub = $em->getRepository(Adversing::class)->find($id);
                    if ($pub){
                        $total = $total + $pub->getMontantTotal();
                        $pub->setIsPaid(true);
                        $pub->setUser($this->getUser());
                        $facture->addAdversing($pub);
                        $em->persist($pub);
                    }
                }
                $facture->setMontant($total);
                $em->persist($facture);
            }
            $em->flush();
        }catch (\Exception $exception){
            dump($exception->getMessage());
            dump($exception->getFile());
            dump($exception->getFile());
            dump($exception->getTraceAsString());
            die();
        }
        return $this->redirectToRoute('site_success_result');
    }

    /**
     * @Route("/paiement/error", name="users_submit_announcement_error")
     */
    public function paiement_error(Request $request): Response
    {
        $id = $request->get('annonceId');
        $Announcement = $this->getDoctrine()->getManager()->getRepository(Announcement::class)->find($id);
        dump('bad news! paiement failed');
        $Announcement->setIsPaid(false);
        dd($Announcement);
    }

    /**
     * @Route("/paiement/cancel", name="users_submit_announcement_cancel")
     */
    public function paiement_cancel(Request $request): Response
    {
        $id = $request->get('annonceId');
        $Announcement = $this->getDoctrine()->getManager()->getRepository(Announcement::class)->find($id);
        dump('bad news! paiement cancled');
        $Announcement->setIsPaid(false);
        dd($Announcement);
    }

    public function uploadImageBase64($image){
        $data = $image;

        $image_array_1 = explode(";", $data);

        $image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);

        $uploadDir = $this->getParameter('announcement').'/';

        $image_name = 'annonce_'. time() . '.png';

        $image_complete_name = $uploadDir . $image_name;

        file_put_contents($image_complete_name, $data);

        return $image_name;
    }


    /**
     * @Route("/load_subcategory", name="load_subcategory")
     */
    public function load_subcategory(Request $request,CategoryRepository $repository): JsonResponse
    {
        $category = $request->request->get('category');
        $category = $repository->findOneBy(['id'=>$category]);
        $result = [];
        foreach ($category->getCategories() as $cat){
            $result[] = ['id'=>$cat->getId(),'libelle'=>$cat->getName()];
        }
        return new JsonResponse($result);
    }

}
