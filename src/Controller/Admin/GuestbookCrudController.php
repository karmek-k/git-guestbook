<?php

namespace App\Controller\Admin;

use App\Entity\Guestbook;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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
            TextField::new('name'),
            AssociationField::new('owner'),
            BooleanField::new('confirmEntries'),
        ];
    }
}
