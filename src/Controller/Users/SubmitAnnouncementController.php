<?php

namespace App\Controller\Users;


use App\Entity\TempPicture;
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
    public function StepUn(Request $request): Response
    {
        $Announcement = new Announcement();

        $form = $this->createForm(SubmitAnnouncementType::class, $Announcement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {        

        }

        return $this->render('users/submit_announcement/index.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/submit/announcement/step-2", name="users_submit_announcement_step_2")
     */
    public function StepTwo(Request $request): Response
    {
        return $this->render('users/submit_announcement/step2.html.twig', []);
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
}
