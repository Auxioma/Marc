<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDiscountController extends AbstractController
{
    /**
     * @Route("/admin/admin/discount", name="admin_admin_discount")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_discount/index.html.twig', [
            'controller_name' => 'AdminDiscountController',
        ]);
    }
}
