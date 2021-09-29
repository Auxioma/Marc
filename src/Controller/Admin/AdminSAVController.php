<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSAVController extends AbstractController
{
    /**
     * @Route("/admin/admin/s/a/v", name="admin_admin_s_a_v")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_sav/index.html.twig', [
            'controller_name' => 'AdminSAVController',
        ]);
    }
}
