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
            //dd($Profile);
            // Upload picture
            $image = $Profile->get('image')->getData();
            $fichier = md5(uniqid()).'.'.$image->guessExtension();
            /*$image->move(
                $this->getParameter('tmp'), $fichier
            );

            $entityManager   = $this->getDoctrine()->getManager();
            $Update_User  = $entityManager->getRepository(Utilisateurs::class)->find($this->getUser()->getId());
            if (!$Update_User) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $this->getUser()->getId()
                );
            }

            $Update_User->setCompagny($Profile->get('Compagny')->getData());
            $Update_User->setName($Profile->get('Name')->getData());
            $Update_User->setFirstName($Profile->get('FirstName')->getData());

            $Update_User->setPicture($fichier);
            $Update_User->setUrl($Profile->get('Url')->getData());
*/

        }
        
        return $this->render('users/profile/index.html.twig', [
            'controller_name' => 'profileController',
            'form' => $Profile->createView(),
        ]);
    }
}
