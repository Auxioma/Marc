<?php

namespace App\Controller\Users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubmitAnnouncementController extends AbstractController
{
    /**
     * @Route("/users/submit/announcement", name="users_submit_announcement")
     */
    public function index(): Response
    {
        return $this->render('users/submit_announcement/index.html.twig', [
            'controller_name' => 'SubmitAnnouncementController',
        ]);
    }
}
