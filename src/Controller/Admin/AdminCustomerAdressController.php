<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCustomerAdressController extends AbstractController
{
    /**
     * @Route("/admin/admin/customer/adress", name="admin_admin_customer_adress")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_customer_adress/index.html.twig', [
            'controller_name' => 'AdminCustomerAdressController',
        ]);
    }
}
