<?php

namespace App\Controller\Users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apqapqa")
 */
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

    /**
     * @Route("/users/my/factures", name="users_my_factures")
     */
    public function factures(): Response
    {
        return $this->render('users/my_history/factures.html.twig', [
            'controller_name' => 'MyHistoryController',
        ]);
    }

    /**
     * @Route("/users/my/facture", name="users_my_facture")
     */
    public function facture(): Response
    {
        return $this->render('users/my_history/facture.html.twig', [
            'controller_name' => 'MyHistoryController',
        ]);
    }

}
