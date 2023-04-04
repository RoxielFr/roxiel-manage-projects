<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\HttpUtils;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;
    private $httpUtils;

    public function __construct(RouterInterface $router, HttpUtils $httpUtils)
    {
        $this->router = $router;
        $this->httpUtils = $httpUtils;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // Customize your redirection here
        $url = $this->router->generate('homepage');

        return new RedirectResponse($url);
    }
}