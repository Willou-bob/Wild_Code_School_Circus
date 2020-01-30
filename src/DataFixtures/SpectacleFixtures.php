<?php

namespace App\DataFixtures;

use App\Entity\Spectacle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SpectacleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $spectacle = new Spectacle();
            $spectacle->setName($faker->realText(10));
            $spectacle->setDescription($faker->realText(50));
            $spectacle->setDate($faker->dateTime);
            $spectacle->setPrice($faker->numberBetween(10,100));
            $spectacle->setImage('Zooka.jpg');

            $manager->persist($spectacle);
        }

        $manager->flush();
    }
}
