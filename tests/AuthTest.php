<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthTest extends WebTestCase
{
    public function testGuestbookAccessUponLoggingIn(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepo */
        $userRepo = static::$container->get(UserRepository::class);
        $user = $userRepo->findOneBy(['username' => 'user']);
        $this->assertNotNull($user);

        $client->loginUser($user);
        $client->request('GET', '/guestbooks');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'My Guestbooks');
    }

    public function testNoGuestbookAccessWhenAnonymous(): void
    {
        $client = static::createClient();

        $client->request('GET', '/guestbooks');

        $this->assertResponseRedirects();
    }

    public function testNoAdminDashboardAccessAsAnonymous(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin');

        $this->assertResponseRedirects();
    }

    public function testNoAdminDashboardAccessAsNormalUser(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepo */
        $userRepo = static::$container->get(UserRepository::class);
        $user = $userRepo->findOneBy(['username' => 'user']);
        $this->assertNotNull($user);

        $client->loginUser($user);
        $client->request('GET', '/admin');

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAdminDashboardAccessAsAdmin(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepo */
        $userRepo = static::$container->get(UserRepository::class);
        $admin = $userRepo->findOneBy(['username' => 'karmek-k']);
        $this->assertNotNull($admin);

        $client->loginUser($admin);
        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
    }
}
