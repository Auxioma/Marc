<?php

namespace App\Controller\Users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyHistoryController extends AbstractController
{
    /**
     * @Route("/users/my/history", name="users_my_history")
     */
    public function index(): Response
    {
        return $this->render('users/my_history/index.html.twig', [
            'controller_name' => 'MyHistoryController',
        ]);
    }
}
