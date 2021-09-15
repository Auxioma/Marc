<?php

namespace App\Controller\Site;

use App\Entity\Announcement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/{idcat}/{id}-{slug}", name="site_product")
     */
    public function index($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Announcement::class);
        $product = $repo->find($id);

dump($product)   ;

        return $this->render('site/product/index.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
        ]);
    }
}
