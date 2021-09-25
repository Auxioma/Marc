<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apqapqa")
 */
class TermsofSalesController extends AbstractController
{
    /**
     * @Route("/site/termsof/sales", name="site_termsof_sales")
     */
    public function index(): Response
    {
        return $this->render('site/termsof_sales/index.html.twig', [
            'controller_name' => 'TermsofSalesController',
        ]);
    }
}
