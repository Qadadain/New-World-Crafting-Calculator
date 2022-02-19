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
            'tradeSkill' => 14
        ],
        [
            'name' => 'Minerai de métal stellaire',
            'tradeSkill' => 14
        ],
        [
            'name' => 'Bois vert',
            'tradeSkill' => 13
        ],
        [
            'name' => 'Charbon de bois',
            'tradeSkill' => 8
        ],
        [
            'name' => 'Lingot d\'acier',
            'tradeSkill' => 8
        ],
        [
            'name' => 'Lingot de fer',
            'tradeSkill' => 8
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