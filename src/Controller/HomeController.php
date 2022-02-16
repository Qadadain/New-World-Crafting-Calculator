<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\Recipe;
use App\Entity\StepRecipe;
use App\Entity\TradeSkill;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $mineraiFer = $em->getRepository(Component::class)->find(1);
        $lingotFerRecipe = new Recipe();
        $lingotFerRecipe->setName('Lingot de fer');
        $lingotEtape1 = new StepRecipe();
        $lingotEtape1->setIngredient($mineraiFer)
            ->setQuantity(4)
            ->setRecipe($lingotFerRecipe);
        $lingotFerRecipe->addStepsRecipe($lingotEtape1);
        $lingotFerComponent = new Component();
        $lingotFerComponent->setName($lingotFerRecipe->getName());
        $lingotFerRecipe->setIngredient($lingotFerComponent);
        $lingotFerComponent->setRecipe($lingotFerRecipe)
            ->setTradeSkill($em->getRepository(TradeSkill::class)->find(7));
        $mineraiFer->addStepRecipe($lingotEtape1);
        $em->persist($lingotFerComponent);
        $em->persist($lingotFerRecipe);
        $em->persist($lingotEtape1);
        $em->flush();

        dd($mineraiFer);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
