<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Provider\GithubResourceOwner;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GithubAuthenticator extends SocialAuthenticator
{
    public function __construct(
        private ClientRegistry $registry,
        private EntityManagerInterface $em,
    ) {}

    private function getGithubClient(): GithubClient
    {
        return $this->registry->getClient('github');
    }

    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'connect_github_check';
    }

    public function getCredentials(Request $request): AccessToken
    {
        return $this->fetchAccessToken($this->getGithubClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var GithubResourceOwner $githubUser */
        $githubUser = $this->getGithubClient()
            ->fetchUserFromToken($credentials);

        $existingUser = $this->em
            ->getRepository(User::class)
            ->findOneBy(['githubId' => $githubUser->getId()]);
        
        // the user exists:
        if ($existingUser) {
            return $existingUser;
        }

        // there is no such user:
        $user = new User();
        $user->setUsername($githubUser->getNickname());
        $user->setGithubId($githubUser->getId());

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // todo
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        // todo
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }
}
