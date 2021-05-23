<?php

namespace App\Controller\Admin;

use App\Entity\GuestbookEntry;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class GuestbookEntryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GuestbookEntry::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('guestbook'),
            AssociationField::new('author'),
            TextareaField::new('content'),
        ];
    }
}
