<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class LoginFailureHandler implements AuthenticationFailureHandlerInterface
{
    private $router;
    private $twig;

    public function __construct(RouterInterface $router, Environment $twig)
    {
        $this->router = $router;
        $this->twig = $twig;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Customize your redirection here
        $url = $this->router->generate('login');

        $content = $this->twig->render('security/login.html.twig', [
            'last_username' => $request->get('_username'),
            'error' => $exception->getMessage(),
        ]);

        return new Response($content, 401);
    }
}
