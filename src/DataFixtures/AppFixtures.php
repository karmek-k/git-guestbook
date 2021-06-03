<?php

namespace App\DataFixtures;

use App\Entity\Guestbook;
use App\Entity\GuestbookEntry;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //
        // I might consider splitting this into separate files
        //

        // Users
        $admin = new User();
        $admin
            ->setUsername('karmek-k')
            ->setGithubId(33288445)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user = new User();
        $user
            ->setUsername('user')
            ->setGithubId(-1);
        $manager->persist($user);

        // Guestbooks
        $adminGuestbook = new Guestbook();
        $adminGuestbook
            ->setOwner($admin)
            ->setName('Admin\'s very own guestbook')
            ->setColor('fFf')
            ->setConfirmEntries(true);
        $manager->persist($adminGuestbook);

        $adminGuestbookNoConfirmation = new Guestbook();
        $adminGuestbookNoConfirmation
            ->setOwner($admin)
            ->setName('no entry confirmation')
            ->setColor('b5fcc3')
            ->setConfirmEntries(false);
        $manager->persist($adminGuestbookNoConfirmation);

        $userGuestbook = new Guestbook();
        $userGuestbook
            ->setOwner($user)
            ->setName('Test guestbook 123')
            ->setColor('c3b5fc')
            ->setConfirmEntries(false);
        $manager->persist($userGuestbook);

        // Entries
        $adminEntry = new GuestbookEntry();
        $adminEntry
            ->setAuthor($admin)
            ->setContent('I love writing code')
            ->setGuestbook($userGuestbook);
        $manager->persist($adminEntry);

        $manager->flush();
    }
}
