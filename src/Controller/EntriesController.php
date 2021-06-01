<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Entity\GuestbookEntry;
use App\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request, Guestbook $guestbook): Response
    {
        // you cannot add entries to your own guestbook
        if ($this->getUser() == $guestbook->getOwner()) {
            $this->addFlash('error', 'You cannot add entries to your own guestbook');
        
            return $this->redirectToRoute('entries_list', [
                'guestbook' => $guestbook->getId()
            ]);
        }

        $entry = new GuestbookEntry();
        $entry
            ->setAuthor($this->getUser())
            ->setGuestbook($guestbook);
        
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entry);
            $em->flush();

            $this->addFlash('success', 'Entry was added successfully');

            return $this->redirectToRoute('entries_list', [
                'guestbook' => $guestbook->getId(),
            ]);
        }

        return $this->render('entries/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
