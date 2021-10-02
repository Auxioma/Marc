<?php

namespace App\Controller\Users;

use App\Entity\Delivery;
use App\Entity\Users;
use App\Form\Users\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/apqapqa")
 */
class profileController extends AbstractController
{
    
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/users/profile/edit", name="users_profile")
     */
    public function index(Request $request): Response
    {
        $Profile = $this->getUser();
        if (!$Profile) {
            throw $this->createNotFoundException(
                'No product found for id ' . $this->getUser()->getId()
            );
        }

        $form = $this->createForm(ProfileType::class, $Profile, ['isReadOnly' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Profile = $form->getData();
            $image = $form->get('image')->getData();
            if ($image){
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('imagelogo'), $fichier
                );
                $Profile->setPicture($fichier);
            }

            $entityManager   = $this->getDoctrine()->getManager();
            $entityManager->persist($Profile);
            $entityManager->flush();

            // Show message customer
            $this->addFlash(
                'ProfileMiseAJour',
                'Votre profile à bien été enregistré..'
            );
            // Go to the show profile
            return $this->redirectToRoute('show_profile');
        }
        
        return $this->render('users/profile/edit.html.twig', [
            'controller_name' => 'profileController',
            'form' => $form->createView(),
            'isView' => false
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/users/profile", name="show_profile")
     */
    public function ShowProfile(Request $request): Response
    {
        $Profile = $this->getUser();
        if (!$Profile) {
            throw $this->createNotFoundException(
                'No product found for id ' . $this->getUser()->getId()
            );
        }

        $form = $this->createForm(ProfileType::class, $Profile, ['isReadOnly' => true]);
        $form->handleRequest($request);
        return $this->render('users/profile/edit.html.twig', [
            'controller_name' => 'profileController',
            'form' => $form->createView(),
            'isView' => true
        ]);
    }
}
