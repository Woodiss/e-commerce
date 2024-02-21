<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\User;
use App\Entity\Voyage;
use App\Entity\VoyageImage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E Commercee');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
  
            MenuItem::section('Users'),
            MenuItem::linkToCrud('utilisateur', 'fa fa-comment', User::class),
            MenuItem::linkToCrud('Voyages', 'fa fa-plane', Voyage::class),
            MenuItem::linkToCrud('Voyages images', 'fa fa-user', VoyageImage::class),
            MenuItem::linkToCrud('Commandes', 'fa fa-user', Orders::class),
        ];
    }
}
