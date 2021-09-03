<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="site_category")
     */
    public function index(): Response
    {
        return $this->render('site/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
