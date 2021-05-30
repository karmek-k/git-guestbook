<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestbooksControllerTest extends WebTestCase
{
    public function testAccessAsAnonymous(): void
    {
        $client = static::createClient();

        $client->request('GET', '/guestbooks');

        $this->assertResponseRedirects();
    }
}
