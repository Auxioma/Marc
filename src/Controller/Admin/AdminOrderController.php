<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
    /**
     * @Route("/admin/admin/order", name="admin_admin_order")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_order/index.html.twig', [
            'controller_name' => 'AdminOrderController',
        ]);
    }
}
