<?php

namespace App\Controller\Users;


use App\Entity\Announcement;
use App\Form\Users\SubmitAnnouncementType;
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

        return $this->render('users/submit_announcement/index.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/submit/api", name="api_users_submit_announcement_pictures")
     */
    public function ApiPictureAnnoucement(Request $request) 
    {
        $output = array('uploaded' => false);

        $file = $request->files->get('file');

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $output['uploaded'] = true;
        $output['fileName'] = $fileName;

        return new JsonResponse($output);
    }
}
