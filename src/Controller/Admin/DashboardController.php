<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Entity\Categorie;
use App\Entity\Gpx;
use App\Entity\Maraude;
use App\Entity\SousCategorie;
use App\Entity\User;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var AdminUrlGenerator
     */
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    /**
     * @Route("/", name="admin_index")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AssocCrudController::class)->generateUrl());

        // redirect to some CRUD controller
//        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($this->adminUrlGenerator->setController(AssocCrudController::class)->generateUrl());
//        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Backoffice Pratik')
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()
            ->disableUrlSignatures();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Association', 'fas fa-arrow-alt-circle-right', Assoc::class)
            ->setDefaultSort(['id' => 'DESC']);
        yield MenuItem::linkToCrud('Maraude', 'far fa-arrow-alt-circle-right', Maraude::class)
            ->setDefaultSort(['id' => 'DESC']);

        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-list', Categorie::class)
            ->setDefaultSort(['ordre' => 'ASC']);
        yield MenuItem::linkToCrud('Sous-catégorie', 'fas fa-list-alt', SousCategorie::class)
            ->setDefaultSort(['ordre' => 'ASC']);
        yield MenuItem::linkToCrud('GPX', 'fas fa-map-marker', Gpx::class)
            ->setDefaultSort(['id' => 'ASC']);
        yield MenuItem::linkToCrud('Ville', 'fas fa-city', Ville::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);

        yield MenuItem::section('API');
        yield MenuItem::linkToUrl('API docs', 'fas fa-server', '/api/docs')
            ->setLinkTarget('_blank');

        yield MenuItem::section('Session');
        if ($this->getUser() !== null) {
            yield MenuItem::linkToLogout('Déconnexion', 'fa fa-sign-out');
        } else {
            yield MenuItem::linktoRoute('Connexion', 'fa fa-id-card', 'fos_user_security_login');
        }

//        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }

    public function configureAssets(): Assets
    {
        $assets = Assets::new()->addJsFile('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA4CDlFCYEsHZPQ2G4FWI8Hypt0QGKWn8I');
        return $assets->addJsFile('js/location-google-autocomplete.js');
    }
}
