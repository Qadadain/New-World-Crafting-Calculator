<?php

namespace App\DataFixtures;

use App\Entity\TradeSkillType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TradeSkillTypeFixtures extends Fixture
{
    public const TYPE = [
        [
            'name' => 'Fabrication',
        ],
        [
            'name' => 'Transformation',
        ],
        [
            'name' => 'Exploitation',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPE as $data) {
            $skillTadeType = new TradeSkillType();
            $skillTadeType->setName($data['name']);

            $manager->persist($skillTadeType);
        }
        $manager->flush();
    }
}
