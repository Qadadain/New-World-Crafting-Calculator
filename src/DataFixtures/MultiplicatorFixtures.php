<?php

namespace App\DataFixtures;

use App\Entity\Multiplicator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MultiplicatorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 36; $i++) {
            $multiplicator = new Multiplicator();
            $multiplicator->setMultiplicator($i);
            $manager->persist($multiplicator);
        }
        $manager->flush();
    }
}
