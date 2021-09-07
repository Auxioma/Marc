<?php

namespace App\Controller\Site;

use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private $AdversingRepository;

    public function __construct(AnnouncementRepository $AnnouncementRepository) 
    {
        $this->AnnouncementRepository = $AnnouncementRepository;
    }
    
    /**
     * @Route("/{id}-{slug}", name="site_category")
     */
    public function index($id): Response
    {
        $Announcement = $this->AnnouncementRepository->AnnonceForTheCategory($id);

        dump($Announcement);
        
        return $this->render('site/category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'Announcement' => $Announcement,
        ]);
    }
}
