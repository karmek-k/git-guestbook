<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Service\GuestbookImageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image/{guestbook}', name: 'image_show')]
    public function index(Guestbook $guestbook, GuestbookImageGenerator $gen): void
    {
        $image = $gen->generate($guestbook->getColor());
        $gen->show($image);
    }
}
