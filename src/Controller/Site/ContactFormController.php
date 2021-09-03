<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/site/contact/form", name="site_contact_form")
     */
    public function index(): Response
    {
        return $this->render('site/contact_form/index.html.twig', [
            'controller_name' => 'ContactFormController',
        ]);
    }
}
