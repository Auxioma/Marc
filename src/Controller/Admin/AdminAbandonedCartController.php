<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAbandonedCartController extends AbstractController
{
    /**
     * @Route("/admin/admin/abandoned/cart", name="admin_admin_abandoned_cart")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_abandoned_cart/index.html.twig', [
            'controller_name' => 'AdminAbandonedCartController',
        ]);
    }
}
