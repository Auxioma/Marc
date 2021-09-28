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
        $firstResolution = 327;
        $lastResolution = 1990;
        $pas = 7;
        $firstwidthparent = 270.234;
        $firstheightparent = 112;

        $firstwidthfisrtEL = 200;
        $firstheightfisrtEL = 111;
        $firstwidthsecondEl = 64;
        $firstheightsecondEl = 66;
        $firstwidththirdEl = 64;
        $firstheightthirdEl = 40;

        $heighttoAdd = 2.89;
        $widthtoadd = 5.178;
        $css = "";
        while (($firstResolution < $lastResolution ) and ($firstwidthparent < 1161.11)) {

            $css .= "@media (min-width: ".$firstResolution."px) and (max-width: ".($firstResolution+6)."px){\n
	                    .parentLayer{\n
		                    height: ".$firstheightparent."px;\n
		                    width: ".$firstwidthparent."px;\n
	                    }\n
	                    .firstEl{\n
		                    height: ".$firstheightfisrtEL."px;\n
		                    width: ".$firstwidthfisrtEL."px;\n
	                    }\n
	                    .secondEl{\n
		                    height: ".$firstheightsecondEl."px;\n
		                    width: ".$firstwidthsecondEl."px;\n
	                    }\n
	                    .thirdEl{\n
		                    height: ".$firstheightthirdEl."px;\n
		                    width: ".$firstwidththirdEl."px;\n
	                    }\n
                    }\n";

            $firstheightparent += 3;
            $firstwidthparent += 7;

            $firstwidthfisrtEL += $widthtoadd;
            $firstheightfisrtEL += $heighttoAdd;
            $firstwidthsecondEl += 1.66;
            $firstheightsecondEl += 1.735;
            $firstwidththirdEl += 1.66;
            $firstheightthirdEl += 1.136;
            $firstResolution+=  $pas;

        }


       // die($css);
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
