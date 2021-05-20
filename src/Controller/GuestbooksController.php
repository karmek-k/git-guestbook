<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuestbooksController extends AbstractController
{
    #[Route('/guestbooks', name: 'guestbooks')]
    public function index(): Response
    {
        return $this->render('guestbooks/index.html.twig', [
            'controller_name' => 'GuestbooksController',
        ]);
    }
}
