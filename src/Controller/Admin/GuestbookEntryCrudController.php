<?php

namespace App\Controller\Admin;

use App\Entity\GuestbookEntry;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GuestbookEntryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GuestbookEntry::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('guestbook'),
            TextField::new('author'),
            TextareaField::new('content'),
        ];
    }
}
