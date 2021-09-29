<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProfilController extends AbstractController
{
    /**
     * @Route("/admin/admin/profil", name="admin_admin_profil")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_profil/index.html.twig', [
            'controller_name' => 'AdminProfilController',
        ]);
    }
}
