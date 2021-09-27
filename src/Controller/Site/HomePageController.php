<?php

namespace App\Controller\Site;

use App\Repository\CategoryRepository;
use App\Repository\AdversingRepository;
use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReplacementAdvertisingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/apqapqa")
 */
class HomePageController extends AbstractController
{
    private $AdversingRepository;
    private $ReplacementAdvertisingRepository;
    private $AnnouncementRepository;
    
    public function __construct(AdversingRepository $AdversingRepository, ReplacementAdvertisingRepository $ReplacementAdvertisingRepository, AnnouncementRepository $AnnouncementRepository)
    {
        $this->AdversingRepository = $AdversingRepository;
        $this->ReplacementAdvertisingRepository = $ReplacementAdvertisingRepository;
        $this->AnnouncementRepository = $AnnouncementRepository;
    }

    /**
     * @Route("/", name="site_home_page")
     */
    public function index(): Response
    {
       
        $Adversing = $this->AdversingRepository->AdversingHomePage();
        $ReplacementAdvertising = $this->ReplacementAdvertisingRepository->AdversingRemplacement();

        // Initialization of all replacement advertisements
        $AllAdPictures = [];
        foreach($ReplacementAdvertising as $e){
            $AllAdPictures[]  = [
                'src'=> 'img/remplacement/' . $e->getPicture(),
                'url'=> '#',
                'position' => $e->getPosition(),
                'empty'=>false
            ];
        }

        // Will fill in the blocks once and for all if there is an ad picture, otherwise the replacement pub
        foreach($AllAdPictures as $key => &$allAdPicture){
            if(isset($Adversing[$key]) and isset($Adversing[$key]->getPicture()[0])){
                $adp = $Adversing[$key];
                $allAdPicture = [
                    'src'=> 'img/adversing/'.$adp->getPicture(),
                    'url'=> $adp->getUrl(),
                    'position' => $adp->getPosition(),
                    'empty'=>false
                ];

            } elseif (isset($ReplacementAdvertising[$key])) {
                $r = $ReplacementAdvertising[$key];
                $allAdPicture = [
                    'src'=> 'img/remplacement/' . $r->getPicture(),
                    'url'=> '',
                    'position' => $r->getPosition(),
                    'empty'=>false
                ];
            }
        }

        // select the VIP annoucement for the homepage  "Offre prenium"
        $groupedOfferts = [];
        $Offert = $this->AnnouncementRepository->PreniumOffert();
        foreach ($Offert as $offer){
            if (isset($groupedOfferts[$offer->getCategory()->getId()]))
                $groupedOfferts[$offer->getCategory()->getId()]['annonces'][] = $offer;
            else
                $groupedOfferts[$offer->getCategory()->getId()] = [
                    'id' => $offer->getCategory()->getId(),
                    'category' => $offer->getCategory()->getName(),
                    'annonces' => [
                        $offer
                    ]
                ];
        }

        $NewOffert = $this->AnnouncementRepository->NewOffert();

        return $this->render('site/home_page/index.html.twig', [
            'controller_name' => 'Zimboo.ch',
            'AllAdPictures' => $AllAdPictures,
            'PreniumOffert' => $Offert,
            'NewOffert' => $NewOffert,
            'groupedOfferts' => $groupedOfferts
        ]);
    }
}
