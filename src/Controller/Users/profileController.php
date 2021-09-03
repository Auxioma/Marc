<?php

namespace App\Controller\Users;

use App\Entity\Users;
use App\Form\Users\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class profileController extends AbstractController
{
    
    /**
     * @Route("/users/profile", name="users_profile")
     */
    public function index(Request $request): Response
    {
        
        $profile = new Users();

        $Profile = $this->createForm(ProfileType::class, $profile); 
        $Profile->handleRequest($request);

        if ($Profile->isSubmitted() && $Profile->isValid()) {

        }
        
        return $this->render('users/profile/index.html.twig', [
            'controller_name' => 'profileController',
            'form' => $Profile->createView(),
        ]);
    }
}
