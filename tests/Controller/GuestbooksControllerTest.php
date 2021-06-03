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
        $tableRowLinks = $crawler->filter('tr a');
    
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'My Guestbooks');
        $this->assertCount($guestbookCount, $tableRowLinks);
    }

    public function testCreatingGuestbook(): void
    {
        $client = static::createClient();

        /** @var UserRepository $userRepo */
        $userRepo = static::$container->get(UserRepository::class);
        $user = $userRepo->findOneBy(['username' => 'user']);

        $client->loginUser($user);

        // guestbook list
        $crawler = $client->request('GET', '/guestbooks');
        $prevGuestbookCount = $crawler->filter('tr a')->count();
        $link = $crawler->selectLink('New guestbook')->link();

        // guestbook form
        $crawler = $client->click($link);
        $form = $crawler->selectButton('Submit')->form();
        $crawler = $client->submit($form, [
            'guestbook[name]' => 'test guestbook',
            'guestbook[color]' => 'abc',
        ]);
        $this->assertResponseRedirects('/guestbooks');

        // guestbook list again
        $crawler = $client->followRedirect();
        $newGuestbookCount = $crawler->filter('tr a')->count();
        
        $this->assertEquals($prevGuestbookCount + 1, $newGuestbookCount);
        $this->assertSelectorTextContains('h1', 'My Guestbooks');
    }
}
