<?php

namespace App\DataFixtures;

use App\Entity\Component;
use App\Entity\Recipe;
use App\Entity\StepRecipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ComponentFixtures extends Fixture  implements DependentFixtureInterface
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function getDependencies(): array
    {
        return [TradeSkillFixtures::class];
    }

    public const COMPONENT = [
        [
            'name' => 'Minerai de fer',
            'tradeSkill' => 13
        ],
        [
            'name' => 'Minerai de métal stellaire',
            'tradeSkill' => 13
        ],
        [
            'name' => 'Bois vert',
            'tradeSkill' => 12
        ],
        [
            'name' => 'Charbon de bois',
            'tradeSkill' => 7
        ],
        [
            'name' => 'lingot d\'acier',
            'tradeSkill' => 7
        ],
        [
            'name' => 'Lingot de fer',
            'tradeSkill' => 7
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::COMPONENT as $data) {
            $component = new Component();
            $component->setName($data['name']);
            $component->setTradeSkill($manager->find('App:TradeSkill', $data['tradeSkill']));
            $component->setSlug(strtolower($this->slugger->slug($component->getName())));

            $manager->persist($component);
        }

        $manager->flush();
    }
}