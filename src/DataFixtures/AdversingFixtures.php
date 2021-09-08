<?php

namespace App\DataFixtures;

use Faker;
use DateInterval;
use App\Entity\Adversing;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdversingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = Faker\Factory::create('fr_FR');

        for($NbAdversing = 1; $NbAdversing <= 20; $NbAdversing++){

            $from   = new \DateTime();
            $from->add(new DateInterval('P' .$NbAdversing. 'D'));
            
            $to   = new \DateTime();
            $to->add(new DateInterval('P' .rand(10,20). 'D'));


            $Adversing = new Adversing();
            $Adversing->setUrl($faker->url);
            $Adversing->setPicture('1.jpg');
            $Adversing->setStartAt($from);
            $Adversing->setEndAt($to);
            $Adversing->setPosition(rand(1,7));
            $Adversing->setIsValid(rand(0,1));

            $manager->persist($Adversing);
            
        }

        $manager->flush();
    }
}