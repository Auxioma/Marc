<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminInvoiceController extends AbstractController
{
    /**
     * @Route("/admin/admin/invoice", name="admin_admin_invoice")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_invoice/index.html.twig', [
            'controller_name' => 'AdminInvoiceController',
        ]);
    }
}
