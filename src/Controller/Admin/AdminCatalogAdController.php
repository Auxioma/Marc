<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCatalogAdController extends AbstractController
{
    /**
     * @Route("/admin/admin/catalog/ad", name="admin_admin_catalog_ad")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_catalog_ad/index.html.twig', [
            'controller_name' => 'AdminCatalogAdController',
        ]);
    }
}
