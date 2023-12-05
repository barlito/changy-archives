<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Resource;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator,
    )
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(ResourceCrudController::class)->generateUrl());

        // return some charts of week transactions something like that
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Changy Archives')
            ->setFaviconPath('https://www.creativefabrica.com/wp-content/uploads/2019/03/Monogram-YC-Logo-Design-by-Greenlines-Studios.jpg')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Ressources');
        yield MenuItem::linkToCrud('Ressources', 'fa-solid fa-globe', Resource::class);

//        yield MenuItem::section('Wallet Settings');
//        yield MenuItem::linkToCrud('Wallets', 'fas fa-wallet', Wallet::class);
//        yield MenuItem::linktoRoute('Bank Wallet', 'fa fa-chart-bar', 'admin_bank_wallet');
    }
}
