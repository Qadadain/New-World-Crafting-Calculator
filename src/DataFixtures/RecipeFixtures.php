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
        $starmetalOre = $manager->find('App:Component', 2);
        $charcoal = $manager->find('App:Component', 4);
        $steelMetal = $manager->find('App:Component', 5);

        $starmetalIngotRecipe = new Recipe();
        $starmetalIngotRecipe->setIngredient($manager->find('App:Component', 7));
        $starmetalIngotRecipe->setSlug(strtolower($this->slugger->slug($starmetalIngotRecipe->getIngredient()->getName())));

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


        $starmetalIngotComponent = $manager->find('App:Component', 7)->setRecipe($starmetalIngotRecipe)
            ->setTradeSkill($manager->find('App:TradeSkill', 8));

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
