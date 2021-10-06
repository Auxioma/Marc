<?php

namespace App\Controller\Users;


use App\datatrans;
use App\Entity\Facture;
use App\Entity\TempPicture;
use App\Entity\Announcement;
use App\Form\Users\SubmitAnnouncementType;
use App\Repository\CategoryRepository;
use App\Repository\PackageAdTextualRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubmitAnnouncementController extends AbstractController
{
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
            if (!isset($_POST['PREMIUM']) and !isset($_POST['GOLD'])){
                $Announcement->setIsPaid(true);
                $Announcement->setMontantTotal(0);
            }
            if ($proceedPaiment){

                $successPath = "https://zimboo.ch/paiement/success?annonceId=".$Announcement->getId();
                $cancelPath = "https://zimboo.ch/paiement/error?annonceId=".$Announcement->getId();
                $errorPath = "https://zimboo.ch/paiement/cancel?annonceId=".$Announcement->getId();

                $montant = $Announcement->getMontantTotal()*100;

                $response = $datatrans->CreateTransaction("zimboo-".$Announcement->getId(),$montant,$successPath,$cancelPath,$errorPath);

                if(isset($response['error'])){
                    dd('error');
                }else{
                   $transactionId = $response['transactionId'];
                   return new RedirectResponse($datatrans::payUrl.$transactionId);
                }

            }

            return$this->redirectToRoute('users_my_history');
        }

        $packsGold = $repPack->findBytypeAsc(1);
        $packsPremium = $repPack->findBytypeAsc(2);
        return $this->render('users/submit_announcement/finalStep.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'Announcement' => $Announcement,
            'packsGold' => $packsGold,
            'packsPremium' => $packsPremium,
            'minGP' => isset($packsGold[0]) ? $packsGold[0] : null,
            'minPP' => isset($packsPremium[0]) ? $packsPremium[0] : null,
        ]);
    }

    /**
     * @Route("/paiement/success", name="users_submit_announcement_success")
     */
    public function paiement_success(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
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
        $em->flush();

        dump('good news');
        dd($Announcement);
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
