<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AssocCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assoc::class;
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
