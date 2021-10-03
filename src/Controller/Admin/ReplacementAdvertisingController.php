<?php

namespace App\Controller\Admin;

use App\Entity\ReplacementAdvertising;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Admin\ReplacementAdvertisingType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReplacementAdvertisingController extends AbstractController
{
    /**
     * @Route("/admin/replacement/advertising", name="admin_replacement_advertising")
     */
    public function index(): Response
    {
        return $this->render('admin/replacement_advertising/list.html.twig', [
            'controller_name' => 'ReplacementAdvertisingController',
            'ListPubRemplacement' => $this->getDoctrine()->getManager()->getRepository(ReplacementAdvertising::class)->findAll(),
        ]);
    }

    /**
     * @Route("/admin/replacement/advertising/edit/{id}", name="admin_replacement_advertising_edit")
     */
    public function edit(Request $request, $id): Response
    {
        $edit = new ReplacementAdvertising();

        $em = $this->getDoctrine()->getManager();
        $ListPubRemplacement = $em->getRepository(ReplacementAdvertising::class)->find($id);
       
        $form = $this->createForm(ReplacementAdvertisingType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            if ($image){
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('remplacement'), $fichier
                );

                if (!$ListPubRemplacement) {
                    throw $this->createNotFoundException(
                        'No product found for id '.$id
                    );
                }

                $ListPubRemplacement->setPicture($fichier);
                $em->flush();

                // Show message customer
                $this->addFlash(
                    'ProfileMiseAJour',
                    'Votre image e bien été enregistré..'
                );
                // Go to the show profile
                return $this->redirectToRoute('admin_replacement_advertising_edit', [
                    'id' => $id
                ]);
                
            }

        }
        
        return $this->render('admin/replacement_advertising/edit.html.twig', [
            'controller_name' => 'ReplacementAdvertisingController',
            'ListPubRemplacement' => $ListPubRemplacement,
            'form' => $form->createView(),
        ]);
    }

}
