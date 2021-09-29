<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMailController extends AbstractController
{
    /**
     * @Route("/admin/admin/mail", name="admin_admin_mail")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_mail/index.html.twig', [
            'controller_name' => 'AdminMailController',
        ]);
    }
}
