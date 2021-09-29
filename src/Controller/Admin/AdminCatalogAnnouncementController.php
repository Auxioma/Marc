<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCatalogAnnouncementController extends AbstractController
{
    /**
     * @Route("/admin/admin/catalog/announcement", name="admin_admin_catalog_announcement")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_catalog_announcement/index.html.twig', [
            'controller_name' => 'AdminCatalogAnnouncementController',
        ]);
    }
}
