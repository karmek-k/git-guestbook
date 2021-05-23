<?php

namespace App\Controller\Admin;

use App\Entity\Guestbook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GuestbookCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guestbook::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('owner'),
            BooleanField::new('confirmEntries'),
        ];
    }
}
