<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;


class AzureAuthenticator extends AbstractAuthenticator
{

    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'azure_check';
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        
        $credentials = $request->get('token'); 
        return new SelfValidatingPassport(new UserBadge($credentials));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('posts'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('app_login'));
    }

}

