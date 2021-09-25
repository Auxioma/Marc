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
            // I find the information from PriceAnnouncement
            $Price = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $email]);

            //$em = $this->getDoctrine()->getManager();
            //$Announcement->setTitle($form->getData('Title'));
            //$Announcement->setTitle($form->getData('Discount'));
            //$Announcement->setTitle($form->getData('ShortDescrition'));
            //$Announcement->setTitle($form->getData('LongDescription'));
            //$Announcement->setTitle($form->getData('LongDescription'));
            //$Announcement->setOffert($form->getData('Offert'));
            

        }

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
