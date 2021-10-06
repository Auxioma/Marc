<?php

namespace App\Controller\Admin;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    private $Users;

    public function __construct(UsersRepository $Users)
    {
        $this->Users = $Users;
    }
    
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {

        
        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'users' => $this->Users->AdminListUserAdmin(),
        ]);
    }
}
