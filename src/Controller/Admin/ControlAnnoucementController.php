<?php

namespace App\Controller\Admin;

use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ControlAnnoucementController extends AbstractController
{
    private $Announcement;

    public function __construct(AnnouncementRepository $Announcement)
    {
        $this->Announcement = $Announcement;
    }
    
    /**
     * @Route("/admin/control/annoucement", name="admin_control_annoucement")
     */
    public function index(): Response
    {
        return $this->render('admin/control_annoucement/index.html.twig', [
            'controller_name' => 'ControlAnnoucementController',
            'annoucement' => $this->Announcement->ViewAnnoncementAdminForValidationList(),
        ]);
    }

    /**
     * @Route("/admin/control/AnnonceValider", name="admin_control_AnnonceValider")
     */
    public function AnnonceValider(): Response
    {
        return $this->render('admin/control_annoucement/index.html.twig', [
            'controller_name' => 'ControlAnnoucementController',
            'annoucement' => $this->Announcement->ViewAnnoncementAdminForValidationListValidate(),
        ]);
    }

}
