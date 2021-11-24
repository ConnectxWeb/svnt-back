<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Entity\Categorie;
use App\Entity\Gpx;
use App\Service\Generic\Flash\FlashMsg;
use App\Service\Generic\Type\BootstrapType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use phpGPX\phpGPX;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class GpxCrudController extends AbstractCrudController
{
    public function __construct()
    {

    }

    public static function getEntityFqcn(): string
    {
        return Gpx::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInPlural('GPX (une fois le fichier importé, il doit être validé en cliquant sur le bouton "Valider GPX")');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('ville'),
            TextField::new('titre', "Titre (qui sera affiché lorsque l'on clique sur le marqueur)")
                ->setRequired(true),
            ImageField::new('gpxFile', 'Fichier GPX')
                ->onlyOnForms()
                ->setBasePath(Gpx::GPX_PATH)
                ->setUploadDir('/public' . Gpx::GPX_PATH)
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(true),
            ImageField::new('logoFilename', 'Picto (qui sera représenté sur la carte)')
                ->setBasePath(Gpx::LOGO_PATH)
                ->setUploadDir('/public' . Gpx::LOGO_PATH)
                ->setFormType(FileUploadType::class)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ColorField::new('traceColor',
                'Couleur du tracé (utilisé uniquement pour les tracés, lignes de métro, tram..)')
                ->onlyOnForms()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $validateGpx = Action::new('validateGpx', 'Valider GPX', 'fa fa-check')
            ->linkToCrudAction('validateGpx')
            ->addCssClass('btn-sm btn-success')
            ->displayIf(static function (GPX $entity) {
                return !$entity->getIsValid();
            });

        return $actions
            ->add(Crud::PAGE_DETAIL, $validateGpx)
            ->add(Crud::PAGE_EDIT, $validateGpx)
            ->add(Crud::PAGE_INDEX, $validateGpx);
    }

    public function validateGpx(AdminUrlGenerator $adminUrlGenerator, Request $request): Response
    {
        /** @var Gpx $gpx */
        $gpx = $this->getContext()->getEntity()->getInstance();
        if (!$gpx instanceof Gpx) {
            throw new \RuntimeException('Objet non GPX.');
        }

        /** @var Session */
        $session = $this->getContext()->getRequest()->getSession();
        $adminUrlGenerator->setController(self::class)
            ->setAction('index')
            ->removeReferrer()
            ->setEntityId(null);

        try {
            $gpxParser = new phpGPX();
            $gpxFile = $gpxParser->load($request->server->get('DOCUMENT_ROOT') . $gpx->getApiGpxFile());
            if (count($gpxFile->waypoints) === 0 && count($gpxFile->routes) === 0 && count($gpxFile->tracks) === 0) {
                $gpx->setIsValid(false);
                $session->getFlashBag()->add(BootstrapType::WARNING,
                    sprintf("<h2>Fichier GPX non valide (il ne contient auncune information à afficher)</h2>Nom: %s<br>Description: %s<br>Créateur: %s",
                        $gpxFile->metadata->name, $gpxFile->metadata->description, $gpxFile->creator));
            } else {
                $gpx->setIsValid(true);
                $session->getFlashBag()->add(BootstrapType::SUCCESS,
                    sprintf("<h2>Fichier GPX validé</h2>Nom: %s<br>Description: %s<br>Créateur: %s<br>Waypoints: %s<br>Routes: %s<br>Tracks: %s",
                        $gpxFile->metadata->name, $gpxFile->metadata->description, $gpxFile->creator,
                        count($gpxFile->waypoints), count($gpxFile->routes), count($gpxFile->tracks)));
            }
            $this->getDoctrine()->getManager()->flush();
        } catch (\Exception $e) {
            $session->getFlashBag()->add(BootstrapType::DANGER, $e->getMessage());
        }

        return $this->redirect($adminUrlGenerator->generateUrl());
    }
}
