<?php

namespace App\Controller;

use App\Entity\Guestbook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntriesController extends AbstractController
{
    #[Route('/entries/{id}', name: 'entries_list')]
    public function entriesList(Guestbook $guestbook): Response
    {
        return $this->render('entries/list.html.twig', [
            'guestbook' => $guestbook,
        ]);
    }
}
