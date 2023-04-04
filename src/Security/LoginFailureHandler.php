<?php

// src/Security/LoginFailureHandler.php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
class LoginFailureHandler implements AuthenticationFailureHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new RedirectResponse($this->router->generate('login'));
    }
}