<?php

namespace App\DataFixtures;

use App\Entity\Furniture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FurnitureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $furnitures = ['Etagère scandinave', 'Armoire 1 porte', 'Armoire miroir', 'Armoire rétro', 'Etagère bibliothèque'];

        foreach ($furnitures as $name) {
            $furniture = new Furniture;
            $furniture->setName($name);
            $furniture->setCraftNumber(mt_rand(0, 10));

            $manager->persist($furniture);
        }

        $manager->flush();
    }
}
