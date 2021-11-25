<?php

namespace App\Controller\Admin;

use App\Entity\AnnuaireCategorie;
use App\Entity\AnnuaireOrganisme;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnnuaireOrganismeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnnuaireOrganisme::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInPlural('Organismes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('categorie', 'Catégorie')
                ->setRequired(true)
                ->setLabel('Catégorie')
                ->setFormTypeOptions(['by_reference' => true]),
            TextField::new('nom', "Nom de l'organisme"),
            TelephoneField::new('telephone', "Numéro de téléphone")
        ];
    }
}
