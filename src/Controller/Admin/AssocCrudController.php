<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use OuvertureType;

class AssocCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assoc::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextEditorField::new('description'),
            TelephoneField::new('telephone'),
            TextField::new('adresse'),
            TextField::new('longitude'),
            TextField::new('latitude'),
            BooleanField::new('homme'),
            BooleanField::new('femme'),
            BooleanField::new('chien'),
            BooleanField::new('handicap'),
            CollectionField::new('ouverture')
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
