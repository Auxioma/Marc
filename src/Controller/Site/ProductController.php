<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="site_product")
     */
    public function index(): Response
    {
        return $this->render('site/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
