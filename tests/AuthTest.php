<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
}
