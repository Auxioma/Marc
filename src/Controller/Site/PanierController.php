<?php

namespace App\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    /**
     * @Route("/panier", name="panier")
     */
    public function panier(Request $request): Response
    {
        return $this->render('site/panier/panier.html.twig');
    }

}