<?php

namespace App\Controller\Admin;

use App\Entity\Guestbook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GuestbookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guestbook::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
