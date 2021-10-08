<?php

namespace App\Controller\Site;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class resultController extends AbstractController
{
    /**
     * @Route("/page/success", name="site_success_result")
     */
    public function success(): Response
    {
        return $this->render('site/results/success.html.twig', []);
    }


    /**
     * @Route("/page/failure", name="site_failure_result")
     */
    public function failure(): Response
    {
        return $this->render('site/results/failure.html.twig', []);
    }


    /**
     * @Route("/page/cancel", name="site_cancel_result")
     */
    public function cancel(): Response
    {
        return $this->render('site/results/cancel.html.twig', []);
    }
}