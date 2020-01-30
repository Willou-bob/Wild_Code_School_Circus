<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setFirstname($faker->realText(20));
            $actor->setLastname($faker->realText(15));
            $actor->setRole($faker->realText(15));
            $actor->setPicture("placeholder.png");
            $actor->setSpectacle($this->getReference('spectacle_' . rand(0, 9)));

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SpectacleFixtures::class];
    }
}