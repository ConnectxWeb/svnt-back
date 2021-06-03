<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Form\OuvertureType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


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
            AssociationField::new('ville'),
            TextField::new('nom'),
            TextEditorField::new('description'),
            TelephoneField::new('telephone'),

            FormField::addPanel('Adresse'),
            TextField::new('adresse')->setCssClass('toto')->addCssClass('map-input'),
            TextField::new('longitude'),
            TextField::new('latitude'),

            FormField::addPanel('Options'),
            AssociationField::new('sousCategories')
                ->setRequired(true)
                ->setLabel('Sous-catégories')
                ->setFormTypeOptions(['by_reference' => false]),
            BooleanField::new('homme'),
            BooleanField::new('femme'),
            BooleanField::new('chien'),
            BooleanField::new('handicap'),

            FormField::addPanel('Horaires'),
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
