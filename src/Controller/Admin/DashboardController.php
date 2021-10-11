<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Entity\Categorie;
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
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
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
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Association', 'fas fa-list', Assoc::class);
        yield MenuItem::linkToCrud('Maraude', 'fas fa-list', Maraude::class);
//        yield MenuItem::linkToCrud('Ouverture', 'fas fa-list', Ouverture::class);

        yield MenuItem::section('Admin');
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Sous-catégorie', 'fas fa-list', SousCategorie::class);
        yield MenuItem::linkToCrud('Ville', 'fas fa-list', Ville::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);

        yield MenuItem::section('User');
        if ($this->getUser() !== null) {
            yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
        } else {
            yield MenuItem::linktoRoute('Login', 'fa fa-id-card', 'fos_user_security_login');
        }
    }

    public function configureAssets(): Assets
    {
        $assets = Assets::new()->addJsFile('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA4CDlFCYEsHZPQ2G4FWI8Hypt0QGKWn8I');
        return $assets->addJsFile('js/location-google-autocomplete.js');
    }
}
