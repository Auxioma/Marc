<?php

namespace App\Controller\Authenticator;

use App\Form\ProfileSecurityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/apqapqa")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('authenticator/security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/changer-le-mot-pass", name="security_edit")
     */
    public function security_edit(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();
        $form = $this->createForm(ProfileSecurityType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if (!$passwordEncoder->isPasswordValid($user, $request->request->get('currentPassword')))
                $this->addFlash('danger', 'Current password incorrect');
            else {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Security details successfully updated');
            }
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return $this->render(
            'users/account/security_edit.html.twig', ['form' => $form->createView()]
        );
    }
}
