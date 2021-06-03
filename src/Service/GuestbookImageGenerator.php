<?php

namespace App\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Point;

class GuestbookImageGenerator
{
    private Imagine $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function generate(string $template, string $hexColor): void
    {
        $image = $this->imagine->open($template);

        $overlaySize = $image->getSize();
        $overlayStart = new Point(0, 0);
        $overlayEnd = new Point(
            $overlaySize->getWidth(),
            $overlaySize->getHeight(),
        );

        $image->draw()->rectangle(
            $overlayStart,
            $overlayEnd,
            $image->palette()->color($hexColor, 10)
        );

        // TODO: make it return a HttpFoundation Response instead
        $image->show('jpg');
    }
}
