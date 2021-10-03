<?php

namespace App\Controller\Users;


use App\Entity\TempPicture;
use App\Entity\Announcement;
use App\Form\Users\SubmitAnnouncementType;
use App\Repository\CategoryRepository;
use App\Repository\PackageAdTextualRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/apqapqa")
 */
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
            $unique = 'createdAnnonce'. uniqid();
            $session = $this->get('session');
            $session->set($unique,$Announcement);
            return $this->redirectToRoute('users_submit_announcement_finalStep',['uuid'=>$unique]);
        }

        return $this->render('users/submit_announcement/index.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/announcement/finalStep/{uuid}", name="users_submit_announcement_finalStep")
     */
    public function finalStep(Request $request,PackageAdTextualRepository $repPack,$uuid): Response
    {
        $session = $this->get('session');
        $Announcement = $session->get($uuid);


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
     * @Route("/users/submit/api", name="api_users_submit_announcement_pictures")
     */
    public function ApiPictureAnnoucement(Request $request) 
    {
        $temp = new TempPicture();
        $em = $this->getDoctrine()->getManager();

        $session_user = $this->getUser()->getId();

        $output = array('uploaded' => false);

        $file = $request->files->get('file');
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move(
            $this->getParameter('announcement'), $fileName
        );

        $temp->setUsers($session_user);
        $temp->setName($fileName);
        $em->persist($temp);
        $em->flush();

        $output['uploaded'] = true;
        $output['fileName'] = $fileName;

        return new JsonResponse($output);
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
