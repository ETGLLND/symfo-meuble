<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Furniture;
use App\Entity\Material;
use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 5; $i++) {
            $supplier = new Supplier();
            $supplier->setName('Supplier ' . $i);
            $manager->persist($supplier);
        }

        $manager->flush();

        for($j = 0; $j < 5; $j++) {
            $supplier = new Category();
            $supplier->setName('Category ' . $j);
            $manager->persist($supplier);
        }

        $manager->flush();

        $supplierRepository= $manager->getRepository(Supplier::class);
        $suppliers = $supplierRepository->findAll();

        for($k = 0; $k < 5; $k++) {
            $material = new Material();
            $material->setName('Material ' . $k);
            $material->setSupplier($suppliers[random_int(0, count($suppliers) - 1)]);
            $manager->persist($material);
        }

        $manager->flush();

        $categoryRepository= $manager->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        $materialRepository= $manager->getRepository(Material::class);
        $materials = $materialRepository->findAll();

        for($l = 0; $l < 5; $l++) {
            $furniture = new Furniture();
            $furniture->setName('Meuble ' . $l);
            $furniture->setCraftNumber(random_int(0, 12));
            $furniture->setCategory($categories[random_int(0, count($categories) - 1)]);
            for($m = 0; $m < random_int(0, count($materials)); $m++) {
                $furniture->addMaterial($materials[random_int(0, count($materials) - 1)]);
            }
            $manager->persist($furniture);
        }
        
        $manager->flush();
    }
}
