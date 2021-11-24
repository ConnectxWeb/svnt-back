<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Form\CategoriesType;
use App\Form\OuvertureType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class AssocCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Assoc::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('ville'),
            TextField::new('nom'),
            TextEditorField::new('description'),
            TelephoneField::new('telephone'),
            ImageField::new('logoFilename', 'Logo')
                ->setBasePath(Assoc::LOGO_PATH)
                ->setUploadDir('/public' . Assoc::LOGO_PATH)
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),

            FormField::addPanel('Adresse'),
            TextField::new('adresse')->setCssClass('toto')->addCssClass('map-input'),
            TextField::new('longitude')
                ->onlyOnForms(),
            TextField::new('latitude')
                ->onlyOnForms(),

            FormField::addPanel('Options'),
            AssociationField::new('categories')
                ->setRequired(true)
                ->setLabel('Catégories')
                ->setFormTypeOptions(['by_reference' => true]),
            AssociationField::new('sousCategories')
                ->setRequired(false)
                ->setLabel('Sous-catégories')
                ->setFormTypeOptions(['by_reference' => true]),
            BooleanField::new('chien')
                ->onlyOnForms(),
            BooleanField::new('handicap')
                ->onlyOnForms(),

            FormField::addPanel('Horaires'),
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
