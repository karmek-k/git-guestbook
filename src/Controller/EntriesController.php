<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntriesController extends AbstractController
{
    #[Route('/entries/{guestbook}', name: 'entries_list')]
    public function entriesList(Guestbook $guestbook): Response
    {
        return $this->render('entries/list.html.twig', [
            'guestbook' => $guestbook,
        ]);
    }

    #[Route('/entries/{guestbook}/create', name: 'entries_create')]
    public function create(Guestbook $guestbook): Response
    {
        // you cannot add entries to your own guestbook
        if ($this->getUser() == $guestbook->getOwner()) {
            // TODO: create a flash message
            // $this->addFlash('error', 'You cannot add entries to your own guestbook')
        
            return $this->redirectToRoute('entries_list', [
                'guestbook' => $guestbook->getId()
            ]);
        }

        $form = $this->createForm(EntryType::class);

        return $this->render('entries/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
