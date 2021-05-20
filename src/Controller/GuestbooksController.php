<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Repository\GuestbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
