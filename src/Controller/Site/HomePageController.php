<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="site_home_page")
     */
    public function index(): Response
    {
        return $this->render('site/home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}
