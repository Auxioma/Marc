<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCustomerListController extends AbstractController
{
    /**
     * @Route("/admin/admin/customer/list", name="admin_admin_customer_list")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_customer_list/index.html.twig', [
            'controller_name' => 'AdminCustomerListController',
        ]);
    }
}
