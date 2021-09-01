<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($i=0;$i<100;$i++)
        {
            $property = new Property();
            $property
                ->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,400))
                ->setPrice($faker->numberBetween())
                ->setFloor($faker->numberBetween(1,15))
                ->setRoom($faker->numberBetween(2,10))
                ->setBedroom($faker->numberBetween(1,9))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setAdress($faker->address)
                ->setCodePostal($faker->postcode)
                ->setSold(false);
            $manager->persist($property);
        }
        $manager->flush();
    }
}
