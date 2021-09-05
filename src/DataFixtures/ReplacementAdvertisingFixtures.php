<?php

namespace App\DataFixtures;

use App\Entity\ReplacementAdvertising;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReplacementAdvertisingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for($NbAdversing = 1; $NbAdversing <= 10; $NbAdversing++){
            
            $ReplacementAdvertising = new ReplacementAdvertising();
            $ReplacementAdvertising->setPicture('1.jpg');
            $ReplacementAdvertising->setPosition($NbAdversing);

            $manager->persist($ReplacementAdvertising);

        }

        $manager->flush();
    }
}
