<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $puRemplacement = [
            [
                'categorie' => 'SANTE/BEAUTE',
            ],
            [
                'categorie' => 'RESTAURANT',
            ],
            [
                'categorie' => 'HÔTEL/VOYAGE',
            ],
            [
                'categorie' => 'OFFRES DU NET',
            ],
            [
                'categorie' => 'SPORT/LOISIR',
            ],
            [
                'categorie' => 'OFFRES DIVERS',
            ],
            [
                'categorie' => 'SERVICES',
            ],
            [
                'categorie' => 'GRAND MAGASIN',
            ],
            [
                'categorie' => ' MAGASINS ',
            ],
        ];

        foreach($puRemplacement as $key => $value){
            $p = new \App\Entity\Category();
            $p->setName($value['categorie']);

            $manager->persist($p);

        }

        $manager->flush();
    }
}
