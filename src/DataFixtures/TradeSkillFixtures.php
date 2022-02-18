<?php

namespace App\DataFixtures;

use App\Entity\TradeSkill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class TradeSkillFixtures extends Fixture implements DependentFixtureInterface
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function getDependencies(): array
    {
        return [TradeSkillTypeFixtures::class];
    }

    public const TRADE_SKILL = [
        [
            'name' => 'Fabrication d\'armes',
            'type' => 1
        ],
        [
            'name' => 'Fabrication d\'armures',
            'type' => 1
        ],
        [
            'name' => 'Ingénieure',
            'type' => 1
        ],
        [
            'name' => 'Joaillerie',
            'type' => 1
        ],
        [
            'name' => 'Arts obscurs',
            'type' => 1
        ],
        [
            'name' => 'Cuisine',
            'type' => 1
        ],
        [
            'name' => 'Ameublement',
            'type' => 1
        ],
        [
            'name' => 'Fonderie',
            'type' => 2
        ],
        [
            'name' => 'Menuiserie',
            'type' => 2
        ],
        [
            'name' => 'Tannerie',
            'type' => 2
        ],
        [
            'name' => 'Tissage',
            'type' => 2
        ],
        [
            'name' => 'Taille de pierre',
            'type' => 2
        ],
        [
            'name' => 'Abattage',
            'type' => 3
        ],
        [
            'name' => 'Extraire',
            'type' => 3
        ],
        [
            'name' => 'Pêche',
            'type' => 3
        ],
        [
            'name' => 'Récolte',
            'type' => 3
        ],
        [
            'name' => 'Pistage et dépeçage',
            'type' => 3
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TRADE_SKILL as $data) {
            $skillTrade = new TradeSkill();
            $skillTrade->setName($data['name'])
                ->setImage('toto');
            $skillTrade->setType($manager->find('App:TradeSkillType', $data['type']));
            $skillTrade->setSlug(strtolower($this->slugger->slug($skillTrade->getName())));

            $manager->persist($skillTrade);
        }
        $manager->flush();
    }
}
