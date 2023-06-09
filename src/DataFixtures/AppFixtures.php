<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(protected UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        
        $user1 = new User();
        $user1->setEmail('maksanikienko30@gmail.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword($this->hasher->hashPassword($user1, '123'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('maks@gmail.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword($this->hasher->hashPassword($user2, '456'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('max@gmail.com');
        $user3->setRoles(['ROLE_USER','ROLE_USER']);
        $user3->setPassword($this->hasher->hashPassword($user3, '789'));
        $manager->persist($user3);
        
        
        $product1 = new Product();
        $product1->setName('Air Conditioner Mitsubishi MSZ-AP24VGK');
        $product1->setDescription('Кондиционер Mitsubishi является превосходным выбором для обеспечения комфортного и приятного климата в помещении. Этот кондиционер отличается высокой энергоэффективностью и мощностью охлаждения.');
        $product1->setPrice(9999);
        $product1->setRating(8);
        $product1->setBrand('Mitsubishi');
        $product1->setAvailability(true);
        $product1->setNumber(10.0);
        $product1->setImage('air_conditioner_mitsubishi-6414602d54e00.png');
        $product1->setPromoted(true);
        $manager->persist($product1);


        $product2 = new Product();
        $product2->setName('Coffee Machine Breville BES870XL');
        $product2->setDescription('Кофейная машина Breville является превосходным решением для любителей свежесваренного кофе. Эта модель отличается высоким качеством изготовления, инновационными функциями и легким использованием.');
        $product2->setPrice(20999);
        $product2->setRating(8);
        $product2->setBrand('Breville');
        $product2->setAvailability(true);
        $product2->setNumber(10.0);
        $product2->setImage('coffee_machine_breville-641461772be60.png');
        $product2->setPromoted(true);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Dyson Supersonic Hair Dryer');
        $product3->setDescription('Dyson Supersonic Hair Dryer представляет собой инновационную модель фена для волос от компании Dyson, которая сочетает в себе высокую производительность, передовую технологию и стильный дизайн. Этот фен обещает эффективное и бережное сушение волос.');
        $product3->setPrice(11999);
        $product3->setRating(8);
        $product3->setBrand('Dyson');
        $product3->setAvailability(true);
        $product3->setNumber(10.0);
        $product3->setImage('dyson_dryer-6414610da6228.png');
        $product3->setPromoted(true);
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName('DishWasher Bosch X7000');
        $product4->setDescription('Посудомоечная машина Bosch - это качественное и надежное устройство, предназначенное для эффективной и удобной мойки посуды. Бренд Bosch известен своим высоким стандартом качества и инновационными технологиями, которые воплощаются в их посудомоечных машинах.');
        $product4->setPrice(12850);
        $product4->setRating(8);
        $product4->setBrand('Bosch');
        $product4->setAvailability(true);
        $product4->setNumber(10.0);
        $product4->setImage('dishwasher_bosch-6414621a7fa05.png');
        $product4->setPromoted(false);
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setName('Dyson PH01 Pure Humidify');
        $product5->setDescription('Dyson PH01 Pure Humidify – это инновационное устройство, сочетающее в себе функции увлажнителя и очистителя воздуха. Это многофункциональное устройство разработано компанией Dyson, известной своими передовыми технологиями и стильным дизайном.');
        $product5->setPrice(15999);
        $product5->setRating(8);
        $product5->setBrand('Dyson');
        $product5->setAvailability(true);
        $product5->setNumber(10.0);
        $product5->setImage('dyson-641347803cc7a.png');
        $product5->setPromoted(false);
        $manager->persist($product5);

        $product6 = new Product();
        $product6->setName('Microwave Panasonic NN-ST342MZPE');
        $product6->setDescription('Panasonic NN-ST342MZPE - это микроволновая печь, представленная компанией Panasonic. Эта модель отличается надежностью, функциональностью и элегантным дизайном.');
        $product6->setPrice(2199);
        $product6->setRating(8);
        $product6->setBrand('Panasonic');
        $product6->setAvailability(true);
        $product6->setNumber(10.0);
        $product6->setImage('microwave-64145e69280be.png');
        $product6->setPromoted(false);
        $manager->persist($product6);

        $product7 = new Product();
        $product7->setName('Refridgerator Gorenje NRS918FMX');
        $product7->setDescription('Gorenje NRS918FMX - это холодильно-морозильная комбинация, представленная компанией Gorenje. Эта модель отличается высокой производительностью, просторным дизайном и передовыми функциями.');
        $product7->setPrice(17999);
        $product7->setRating(8);
        $product7->setBrand('Gorenje');
        $product7->setAvailability(true);
        $product7->setNumber(10.0);
        $product7->setImage('refrigerator-64145ee4d37d8.png');
        $product7->setPromoted(false);
        $manager->persist($product7);

        $product8 = new Product();
        $product8->setName('Washing Machine LG F4DV710S1E');
        $product8->setDescription('LG F4DV710S1E - это модель стиральной машины, предлагаемая компанией LG. Эта стиральная машина известна своими передовыми функциями, надежной производительностью и удобным дизайном.');
        $product8->setPrice(15999);
        $product8->setRating(8);
        $product8->setBrand('LG');
        $product8->setAvailability(true);
        $product8->setNumber(10.0);
        $product8->setImage('washing_machine_lg-64145f899c039.png');
        $product8->setPromoted(false);
        $manager->persist($product8);


        $manager->flush();
    }
}
