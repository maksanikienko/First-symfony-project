<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('Product 1');
        $product1->setDescription('-');
        $product1->setPrice(10.0);
        $product1->setRating(8);
        $product1->setBrand('LG');
        $product1->setAvailability(true);
        $product1->setNumber(10.0);
        $product1->setPromoted(true);
        
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Product 2');
        $product2->setDescription('-');
        $product2->setPrice(10.0);
        $product2->setRating(8);
        $product2->setBrand('LG');
        $product2->setAvailability(true);
        $product2->setNumber(10.0);
        $product2->setPromoted(true);
        
        $manager->persist($product2);
        $manager->flush();
    }
}
