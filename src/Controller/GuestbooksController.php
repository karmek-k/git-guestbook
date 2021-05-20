<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Form\GuestbookType;
use App\Repository\GuestbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuestbooksController extends AbstractController
{
    #[Route('/guestbooks', name: 'guestbooks_list')]
    public function index(GuestbookRepository $repo): Response
    {
        $user = $this->getUser();
        $guestbooks = $repo->findBy(['owner' => $user]);

        return $this->render('guestbooks/index.html.twig', [
            'guestbooks' => $guestbooks,
        ]);
    }

    #[Route('/guestbooks/create', name: 'guestbooks_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $guestbook = new Guestbook();
        $guestbook->setOwner($this->getUser());

        $form = $this->createForm(GuestbookType::class, $guestbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('guestbooks/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
