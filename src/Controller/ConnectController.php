<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectController extends AbstractController
{
    #[Route('/connect/github', name: 'connect_github')]
    public function connectGithub(ClientRegistry $registry): Response
    {
        return $registry
            ->getClient('github')
            ->redirect([], []);
    }

    #[Route('/connect/github/check', name: 'connect_github_check')]
    public function connectGithubCheck(): Response
    {
        $this->addFlash('success', 'You have been logged in');

        return $this->redirectToRoute('guestbooks_list');
    }

    #[Route('/logout', name: 'connect_logout')]
    public function logout()
    {
        return $this->redirectToRoute('home');
    }
}
