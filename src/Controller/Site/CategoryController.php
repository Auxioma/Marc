<?php

namespace App\Controller\Site;

use App\Repository\AnnouncementRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/apqapqa")
 */
class CategoryController extends AbstractController
{
    private $AdversingRepository;
    private $categoryRepository;

    public function __construct(AnnouncementRepository $AnnouncementRepository,CategoryRepository $categoryRepository)
    {
        $this->AnnouncementRepository = $AnnouncementRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @Route("/{id}-{slug}", name="site_category")
     */
    public function index($id, Request $request, PaginatorInterface $paginator): Response
    {
        
        // I need the page ID for filter the annoncement Gold Silver and Free
        // ID = 0 for the Gold
        // ID = 1 for the Silver
        // ID > 2 For the free
        $filter = $request->query->getInt('page');

        $categorie = $this->categoryRepository->find($id);
        $Announcement = $paginator->paginate(
            $this->AnnouncementRepository->AnnonceForTheCategory($id, $filter),
            $request->query->getInt('page', 1), 
            32
        );

        $pagination = $paginator->paginate(
            $this->AnnouncementRepository->pagination($id),
            $request->query->getInt('page', 1), 
            32
        );
        return $this->render('site/category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'Announcement' => $Announcement,
            'pagination' => $pagination,
            'categorie' => $categorie
        ]);
    }
}
