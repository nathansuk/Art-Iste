<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\NewsCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');

        yield MenuItem::section('Actualité', 'fas fa-atlas');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-bars', NewsCategory::class);
        yield MenuItem::linkToCrud('Les articles', 'fas fa-book-open', Articles::class);

        yield MenuItem::section('Communauté', 'fas fa-globe-europe');
        yield MenuItem::linkToCrud('Comptes utilisateur', 'fas fa-users', User::class);
    }
}
