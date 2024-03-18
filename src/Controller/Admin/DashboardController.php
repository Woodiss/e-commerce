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
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(VoyageCrudController::class)->generateUrl());
        
        // return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E Commercee');
    }

    public function configureMenuItems(): iterable
    {
        return [
            // MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Voyages'),
            MenuItem::linkToCrud('Voyages', 'fa fa-plane', Voyage::class),
            MenuItem::linkToCrud('Voyages images', 'fa-solid fa-image', VoyageImage::class),
            
            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('utilisateurs', 'fa fa-user', User::class),
            MenuItem::linkToCrud('Commandes', 'fa-solid fa-box-open', Orders::class),
        ];
    }
}
