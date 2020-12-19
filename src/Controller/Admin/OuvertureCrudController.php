<?php

namespace App\Controller\Admin;

use App\Entity\Ouverture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OuvertureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ouverture::class;
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
