<?php

namespace App\Controller;

use App\Entity\Guestbook;
use App\Service\GuestbookImageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image/{guestbook}/get', name: 'image_get')]
    public function getImage(Guestbook $guestbook, GuestbookImageGenerator $gen): void
    {
        $image = $gen->generate($guestbook->getColor());
        $gen->show($image);
    }
}
