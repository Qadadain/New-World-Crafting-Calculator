<?php

namespace App\Controller\Admin;

use App\Entity\Component;
use App\Entity\Recipe;
use App\Entity\StepRecipe;
use App\Entity\TradeSkill;
use App\Entity\TradeSkillType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ComponentCrudController::class)->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('New World Crafting Calculator');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Composants', 'fas fa-list', Component::class);
        yield MenuItem::linkToCrud('Recettes', 'fas fa-list', Recipe::class);
        yield MenuItem::linkToCrud('Ingrédients', 'fas fa-list', StepRecipe::class);
        yield MenuItem::linkToCrud('Type de métier', 'fas fa-list', TradeSkillType::class);
        yield MenuItem::linkToCrud('Métier', 'fas fa-list', TradeSkill::class);
    }
}
