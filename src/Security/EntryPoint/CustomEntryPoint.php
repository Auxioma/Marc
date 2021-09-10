<?php

namespace App\Security\EntryPoint;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class CustomEntryPoint implements AuthenticationEntryPointInterface
{
    Private $UrlGeneratorInterface;
    
    public function __construct(UrlGeneratorInterface $UrlGeneratorInterface)
    {
        $this->UrlGeneratorInterface = $UrlGeneratorInterface;
    }

    public function start(Request $request, AuthenticationException $authException = null) : Response
    {
        return new RedirectResponse($this->UrlGeneratorInterface->generate('app_login'));
    }
}
  