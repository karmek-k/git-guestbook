<?php

namespace App\Service;

use Imagine\Gd\Image;
use Imagine\Gd\Imagine;
use Imagine\Image\Point;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class GuestbookImageGenerator
{
    private Imagine $imagine;
    private Package $package;

    public function __construct()
    {
        $this->imagine = new Imagine();
        $this->package = new Package(new EmptyVersionStrategy());
    }

    public function generate(string $hexColor): Image
    {
        $templateUrl = $this->package
            ->getUrl('images/guestbook_template.jpg');
        $image = $this->imagine->open($templateUrl);

        $overlaySize = $image->getSize();
        $overlayStart = new Point(0, 0);
        $overlayEnd = new Point(
            $overlaySize->getWidth(),
            $overlaySize->getHeight(),
        );

        $image->draw()->rectangle(
            $overlayStart,
            $overlayEnd,
            $image->palette()->color($hexColor, 50),
            fill: true,
        );

        return $image;
    }

    public function show(Image $image, string $format = 'jpg'): void
    {
        // TODO: make it return a HttpFoundation Response instead
        $this->image->show($format);
    }
}
