<?php

namespace App\DataFixtures;

use App\Entity\Component;
use App\Entity\Recipe;
use App\Entity\StepRecipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function getDependencies(): array
    {
        return [TradeSkillFixtures::class, ComponentFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $starmetalOre = $manager->find('App:Component', 1);
        $charcoal = $manager->find('App:Component', 3);
        $steelMetal = $manager->find('App:Component', 4);

        $starmetalIngotRecipe = new Recipe();
        $starmetalIngotRecipe->setName('Lingot de métal stellaire');
        $starmetalIngotRecipe->setSlug(strtolower($this->slugger->slug($starmetalIngotRecipe->getName())));

        $stepStarmetalOre = new StepRecipe();
        $stepStarmetalOre->setIngredient($starmetalOre)
            ->setQuantity(6)
            ->setRecipe($starmetalIngotRecipe);
        $stepCharcoal = new StepRecipe();
        $stepCharcoal->setIngredient($charcoal)
            ->setQuantity(2)
            ->setRecipe($starmetalIngotRecipe);
        $stepSteelMetal = new StepRecipe();
        $stepSteelMetal->setIngredient($steelMetal)
            ->setQuantity(2)
            ->setRecipe($starmetalIngotRecipe);
        $starmetalIngotRecipe->addStepsRecipe($stepSteelMetal);
        $starmetalIngotRecipe->addStepsRecipe($stepCharcoal);
        $starmetalIngotRecipe->addStepsRecipe( $stepStarmetalOre);
        $starmetalIngotComponent = new Component();
        $starmetalIngotComponent->setName($starmetalIngotRecipe->getName());
        $starmetalIngotComponent->setSlug(strtolower($this->slugger->slug($starmetalIngotRecipe->getName())));

        $starmetalIngotRecipe->setIngredient($starmetalIngotComponent);
        $starmetalIngotComponent->setRecipe($starmetalIngotRecipe)
            ->setTradeSkill($manager->find('App:TradeSkill', 7));

        $starmetalOre->addStepRecipe($stepStarmetalOre);
        $steelMetal->addStepRecipe($stepSteelMetal);
        $charcoal->addStepRecipe($stepCharcoal);

        $manager->persist($starmetalIngotComponent);
        $manager->persist($starmetalIngotRecipe);
        $manager->persist($stepStarmetalOre);
        $manager->persist($stepSteelMetal);
        $manager->persist($stepCharcoal);

        $manager->flush();
    }
}
