<?php

namespace App\Controller\Admin;

use App\Entity\Assoc;
use App\Entity\Maraude;
use App\Entity\Ouverture;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(VilleCrudController::class)->generateUrl());
//        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back')
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Ville', 'fas fa-list', Ville::class);

//        yield MenuItem::section('Association');
        yield MenuItem::linkToCrud('Assoc', 'fas fa-list', Assoc::class);
        yield MenuItem::linkToCrud('Maraude', 'fas fa-list', Maraude::class);
        yield MenuItem::linkToCrud('Ouverture', 'fas fa-list', Ouverture::class);
    }
}
