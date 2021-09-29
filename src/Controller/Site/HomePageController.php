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
        $firstwidthsecondEl = 100;
        $firstheightsecondEl = 50;
        $firstwidththirdEl = 100;
        $firstheightthirdEl = 50;

        $heighttoAdd = 2.49;
        $widthtoadd = 4.25;
        $css = "";
        while (($firstResolution < $lastResolution ) and ($firstwidthparent < 1261.11)) {

            if ($firstwidthparent>760)
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
            else
                $css .= "@media (min-width: ".$firstResolution."px) and (max-width: ".($firstResolution+6)."px){\n
                            .parentLayer{\n
                                height: 386px;\n
                                width: ".$firstwidthparent."px;\n
                            }\n
                            .firstEl{\n
                                height: 228px !important;\n
                                width: 100%;\n
                            }\n
                            .secondEl{\n
                                 height: 148px;\n
                                 width: calc(50% - 5px );\n
                                 left: 0px !important;\n
                                 bottom: 0px !important;\n
                                 top: unset;
                            }\n
                            .thirdEl{\n
                                 height: 148px;\n
                                 width: calc(50% - 5px );\n
                            }\n
                        }\n";

            $firstheightparent += 3;
            $firstwidthparent += 7;


            $firstheightfisrtEL = $heighttoAdd;
            $firstwidthsecondEl += 2.432;
            $firstheightsecondEl += 1.512;
            $firstwidththirdEl += 2.432;
            $firstheightthirdEl += 1.514;
            $firstwidthfisrtEL = ($firstwidthparent-$firstwidthsecondEl-10);
            $firstResolution+=  $pas;

        }

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
