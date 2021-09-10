<?php

namespace App\Security;

use App\Entity\User; // your user entity
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class GoogleAuthenticator extends OAuth2Authenticator
{
    private $clientRegistry;
    private $entityManager;
    private $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_google_check';
    }

    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('google');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken, function() use ($accessToken, $client) {
                /** @varGoogleUser $google */
                $google = $client->fetchUserFromToken($accessToken);
dd($google);
                $email = $google->getEmail();

                // 1) have they logged in withGoogle before? Easy!
                // $existingUser = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $google->getId()]);

                // if ($existingUser) {
                //    return $existingUser;
                // }

                $user = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $email]);
                if (!$user) {
                    $API_Password = 'https://api.motdepasse.xyz/create/?include_digits&include_special_characters&include_lowercase&password_length=10&quantity=1';
                    $MDP = file_get_contents($API_Password);

                    $users = new Users();
                    $users->setEmail($email);
                    $users->setRoles(["ROLE_USER"]);
                    $users->setIsVerified('1');
                }

                // 3) Maybe you just want to "register" them by creating
                // a User object
                // $user->setgoogleId($google->getId());
                // $this->entityManager->persist($user);
                // $this->entityManager->flush();

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // change "app_homepage" to some route in your app
        $targetUrl = $this->router->generate('app_homepage');

        return new RedirectResponse($targetUrl);
    
        // or, on success, let the request continue to be handled by the controller
        //return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }
}