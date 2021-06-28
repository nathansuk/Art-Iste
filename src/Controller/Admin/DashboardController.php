<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Artisan;
use App\Entity\ArtisanPhotos;
use App\Entity\ArtisansJob;
use App\Entity\NewsCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

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

        yield MenuItem::section('Artisans', 'fas fa-globe-europe');
        yield MenuItem::linkToCrud('Métiers', 'fas fa-air-freshener', ArtisansJob::class);
        yield MenuItem::linkToCrud('Artisans', 'fas fa-users', Artisan::class);
        yield MenuItem::linkToCrud('Photos', 'fas fa-images', ArtisanPhotos::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToRoute('Retourner sur le site', 'fas fa-arrow-circle-left', 'home'),
            ]);
    }
}
