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
     * @IsGranted("ROLE_ENR")
     * @Route("/users/profile/edit", name="users_profile")
     */
    public function index(Request $request): Response
    {
        
        $profile = new Users();

        $Profile = $this->createForm(ProfileType::class, $profile); 
        $Profile->handleRequest($request);

        if ($Profile->isSubmitted() && $Profile->isValid()) {

            // Upload picture
            $image = $Profile->get('image')->getData();
            $fichier = md5(uniqid()).'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('imagelogo'), $fichier
            );

            // Update the User
            $entityManager   = $this->getDoctrine()->getManager();
            $Update_User  = $entityManager->getRepository(Users::class)->find($this->getUser()->getId());
            if (!$Update_User) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $this->getUser()->getId()
                );
            }

            // Table the open Hour
            $openHour = [
                'LundiMatinOuverture'   => [$Profile->get('LundiMatinOuverture')->getData()],
                'LundiMidiFermeture'    => [$Profile->get('LundiMidiFermeture')->getData()],
                'LundiAPMOuverture'     => [$Profile->get('LundiAPMOuverture')->getData()],
                'LundiAPMFermeture'     => [$Profile->get('LundiAPMFermeture')->getData()],

                'MardiMatinOuverture'    => [$Profile->get('MardiMatinOuverture')->getData()],
                'MardiMidiFermeture'     => [$Profile->get('MardiMidiFermeture')->getData()],
                'MardiAPMOuverture'      => [$Profile->get('MardiAPMOuverture')->getData()],
                'MardiAPMFermeture'      => [$Profile->get('MardiAPMFermeture')->getData()],

                'MercrediMatinOuverture' => [$Profile->get('MercrediMatinOuverture')->getData()],
                'MercrediMidiFermeture'  => [$Profile->get('MercrediMidiFermeture')->getData()],
                'MercrediAPMOuverture'   => [$Profile->get('MercrediAPMOuverture')->getData()],
                'MercrediAPMFermeture'   => [$Profile->get('MercrediAPMFermeture')->getData()],

                'JeudiMatinOuverture'    => [$Profile->get('JeudiMatinOuverture')->getData()],
                'JeudiMidiFermeture'     => [$Profile->get('JeudiMidiFermeture')->getData()],
                'JeudiAPMOuverture'      => [$Profile->get('JeudiAPMOuverture')->getData()],
                'JeudiAPMFermeture'      => [$Profile->get('JeudiAPMFermeture')->getData()],

                'VendrediMatinOuverture' => [$Profile->get('VendrediMatinOuverture')->getData()],
                'VendrediMidiFermeture'  => [$Profile->get('VendrediMidiFermeture')->getData()],
                'VendrediAPMOuverture'   => [$Profile->get('VendrediAPMOuverture')->getData()],
                'VendrediAPMFermeture'   => [$Profile->get('VendrediAPMFermeture')->getData()],

                'SamediMatinOuverture'   => [$Profile->get('SamediMatinOuverture')->getData()],
                'SamediMidiFermeture'    => [$Profile->get('SamediMidiFermeture')->getData()],
                'SamediAPMOuverture'     => [$Profile->get('SamediAPMOuverture')->getData()],
                'SamediAPMFermeture'     => [$Profile->get('SamediAPMFermeture')->getData()],

                'DimancheMatinOuverture' => [$Profile->get('DimancheMatinOuverture')->getData()],
                'DimancheMidiFermeture'  => [$Profile->get('DimancheMidiFermeture')->getData()],
                'DimancheAPMOuverture'   => [$Profile->get('DimancheAPMOuverture')->getData()],
                'DimancheAPMFermeture'   => [$Profile->get('DimancheAPMFermeture')->getData()],
            ];


            $Update_User->setCompagny($Profile->get('Compagny')->getData());
            $Update_User->setName($Profile->get('Name')->getData());
            $Update_User->setFirstName($Profile->get('FirstName')->getData());
            $Update_User->setAddress($Profile->get('Address')->getData());
            $Update_User->setCodePost($Profile->get('CodePost')->getData());
            $Update_User->setDepartment($Profile->get('Department')->getData());
            $Update_User->setDepartment($Profile->get('Department')->getData());
            $Update_User->setPicture($fichier);
            $Update_User->setDepartment($Profile->get('Department')->getData());
            $Update_User->setUrl($Profile->get('Url')->getData());
            $Update_User->setLatitude($Profile->get('Latitude')->getData());
            $Update_User->setLongitude($Profile->get('Longitude')->getData());
            $Update_User->setCity($Profile->get('City')->getData());
            $Update_User->setOpenHours($openHour); 

            // I change The USER ROLE for the customer FULL ACCESS
            $Update_User->setRoles(['ROLE_USER']);

            // Save the delivery
            $insert_delivery = $this->getDoctrine()->getManager();
            $delivery = new Delivery();

            $delivery->setUsers($Update_User);
            $delivery->setName('Eatch');
            $delivery->setUrl($Profile->get('Eatch')->getData());

            $delivery->setUsers($Update_User);
            $delivery->setName('smood');
            $delivery->setUrl($Profile->get('smood')->getData());

            $delivery->setUsers($Update_User);
            $delivery->setName('dealdind');
            $delivery->setUrl($Profile->get('dealdind')->getData());

            $delivery->setUsers($Update_User);
            $delivery->setName('Perso');
            $delivery->setUrl($Profile->get('Perso')->getData());


            $entityManager->persist($Update_User);
            $entityManager->flush();

            $insert_delivery->persist($delivery);
            $insert_delivery->flush();

            
            // Show message customer
            $this->addFlash(
                'ProfileMiseAJour',
                'Votre profile à bien été enregistré..'
            );

            // Go to the show profile
            return $this->redirectToRoute('show_profile', [
                'id' => $this->getUser()->getId()
            ]);
        }
        
        return $this->render('users/profile/edit.html.twig', [
            'controller_name' => 'profileController',
            'form' => $Profile->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/users/profile", name="show_profile")
     */
    public function ShowProfile(Request $request): Response
    {
        
        dump($this->getDoctrine()->getRepository(Users::class)->find($this->getUser()->getId()));

        return $this->render('users/profile/view.html.twig', [
            'controller_name' => 'ProfileController',
            'Utilisateurs' => $this->getDoctrine()->getRepository(Users::class)->find($this->getUser()->getId()),
        ]);
    }
}
