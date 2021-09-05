<?php

namespace App\Controller\Site;

use App\Repository\AdversingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReplacementAdvertisingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    private $AdversingRepository;
    private $ReplacementAdvertisingRepository;
    
    public function __construct(AdversingRepository $AdversingRepository, ReplacementAdvertisingRepository $ReplacementAdvertisingRepository)
    {
        $this->AdversingRepository = $AdversingRepository;
        $this->ReplacementAdvertisingRepository = $ReplacementAdvertisingRepository;
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
        foreach($ReplacementAdvertising as $ReplacementAdvertising){
            $AllAdPictures[]  = [
                'src'=> 'img/adversing/' . $ReplacementAdvertising->getPicture(),
                'url'=> '',
                'position' => $ReplacementAdvertising->getPosition(),
                'empty'=>false
            ];
        }

        // Will fill in the blocks once and for all if there is an ad picture, otherwise the replacement pub
        foreach($AllAdPictures as $key => $allAdPicture){
            if(isset($Adversing[$key]) and isset($Adversing[$key]->getPicture()[0])){
                $adp = $Adversing[$key];
                $allAdPicture = [
                    'src'=> 'img/adversing/'.$adp->getPicture(),
                    'url'=> $adp->getUrl(),
                    'position' => $adp->getPosition(),
                    'empty'=>false
                ];

            } /*elseif( isset($ReplacementAdvertising[$key]) ) { 
                $allAdPicture = [
                    'src'=> 'img/adversing/' . $ReplacementAdvertising[$key]->getPicture(),
                    'url'=> '',
                    'position' => $ReplacementAdvertising[$key]->getPosition(),
                    'empty'=>false
                ];
            }*/
        }

        return $this->render('site/home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'AllAdPictures' => $AllAdPictures
        ]);
    }
}
