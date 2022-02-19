<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/component', name: 'component_')]
class ComponentController extends AbstractController
{
    #[Route('/{slug}', name: 'show')]
    public function show(EntityManagerInterface $em, string $slug): Response
    {
        $component = $em->getRepository('App:Component')->findOneBy(
            ['slug' => $slug]
        );
        $recipeId = $component->getRecipe()->getId();
        $stepRecipes = $em->getRepository('App:StepRecipe');
        $stepRecipes = $stepRecipes->getSortIngredients($recipeId);
        return $this->render('component/show.html.twig', [
            'component' => $component,
            'ingredients' => $stepRecipes
        ]);
    }
}
