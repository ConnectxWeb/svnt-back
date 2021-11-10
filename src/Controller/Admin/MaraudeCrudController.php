<?php

namespace App\Controller\Admin;

use App\Entity\Maraude;
use App\Form\CategoriesType;
use App\Form\OuvertureType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MaraudeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maraude::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('assoc'),
            TextField::new('nom'),
            TextEditorField::new('description'),
            TelephoneField::new('telephone'),
            TextField::new('adresse'),
            TextField::new('longitude'),
            TextField::new('latitude'),

            CollectionField::new('ouverture')
                ->renderExpanded()
                ->allowAdd()
                ->allowDelete()
                ->setEntryIsComplex(true)
                ->setEntryType(OuvertureType::class)
                ->setFormTypeOptions([
                    'by_reference' => 'false'
                ]),
        ];
    }
}
