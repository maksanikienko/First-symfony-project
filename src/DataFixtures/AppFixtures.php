<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;

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
        $product1->setImage('air_conditioner_mitsubishi-6414602d54e00.png');
        $product1->setPromoted(true);

        $user1 = new User();
        $user1->setEmail('maksanikienko30@gmail.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword('123');

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('maks@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword('456');

        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('max@gmail.com');
        $user3->setRoles(['ROLE_USER','ROLE_USER']);
        $user3->setPassword('789');

        $manager->persist($user3);
        
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Product 2');
        $product2->setDescription('-');
        $product2->setPrice(10.0);
        $product2->setRating(8);
        $product2->setBrand('LG');
        $product2->setAvailability(true);
        $product2->setNumber(10.0);
        $product2->setImage('coffee_machine_breville-641461772be60.png');
        $product2->setPromoted(true);
        
        $manager->persist($product2);
        $manager->flush();
    }
}
