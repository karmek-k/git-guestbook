<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestbooksControllerTest extends WebTestCase
{
    public function testAccessAsAnonymous(): void
    {
        $client = static::createClient();

        $client->request('GET', '/guestbooks');

        $this->assertResponseRedirects();
    }

    public function testFetchingGuestbooks(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepo */
        $userRepo = static::$container->get(UserRepository::class);
        $user = $userRepo->findOneBy(['username' => 'user']);
        $guestbookCount = $user->getGuestbooks()->count();

        $client->loginUser($user);
        $crawler = $client->request('GET', '/guestbooks');
        // minus the header row
        $tableRowCount = $crawler->filter('tr')->count() - 1;
    
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'My Guestbooks');
        $this->assertEquals($guestbookCount, $tableRowCount);
    }
}
