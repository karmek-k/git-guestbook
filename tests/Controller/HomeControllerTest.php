<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testAccess(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Modern guestbooks for GitHub');
    }

    // public function testAccessAsAnonymous(): void
    // {
    //     $client = static::createClient();

    //     $client->request('GET', '/');

    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('a', 'Log in with GitHub');
    // }

    // public function testAccessAsLoggedIn(): void
    // {
    //     $client = static::createClient();

    //     /** @var UserRepository $userRepo */
    //     $userRepo = static::$container->get(UserRepository::class);
    //     $user = $userRepo->findOneBy(['username' => 'user']);
    //     $this->assertNotNull($user);

    //     $client->request('GET', '/');
    //     $client->loginUser($user);

    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('a', 'Log out');
    // }
}
