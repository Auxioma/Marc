<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/admin/category", name="admin_admin_category")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
        ]);
    }
}
