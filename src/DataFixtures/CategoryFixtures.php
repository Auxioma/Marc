<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = [
           1 => [
                'id ' => '2',
                'parent_id' => '1',
                'name' => 'RESTAURANT',
                'slug' => 'RESTAURANT',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            2 => [
                'id ' => '3',
                'parent_id' => '1',
                'name' => 'HÔTEL/VOYAGE',
                'slug' => 'HOTEL-VOYAGE',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            3 => [
                'id ' => '4',
                'parent_id' => '1',
                'name' => 'OFFRES DU NET',
                'slug' => 'OFFRES-DU-NET',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            4 => [
                'id ' => '5',
                'parent_id' => '1',
                'name' => 'SPORT-LOISIR',
                'slug' => 'SPORT-LOISIR',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            5 => [
                'id ' => '6',
                'parent_id' => '1',
                'name' => 'OFFRES DIVERS',
                'slug' => 'OFFRES-DIVERS',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            6 => [
                'id ' => '7',
                'parent_id' => '1',
                'name' => 'SERVICES',
                'slug' => 'SERVICES',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            7 => [
                'id ' => '8',
                'parent_id' => '1',
                'name' => 'GRAND MAGASIN',
                'slug' => 'GRAND-MAGASIN',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            8 => [
                'id ' => '9',
                'parent_id' => '1',
                'name' => 'MAGASINS',
                'slug' => 'MAGASINS',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
            9 => [
                'id ' => '10',
                'parent_id' => '1',
                'name' => 'SANTE/BEAUTE',
                'slug' => 'SANTE-BEAUTE',
                'picture' => '1000x1000',
                'subCategories' => [
                    [
                        'name' => 'Catégorie 1',
                        'slug' => 'Categorie-1'
                    ],
                    [
                        'name' => 'Catégorie 2',
                        'slug' => 'Categorie-2'
                    ]
                ]
            ],
        ];

        foreach($category as $key => $value){
            $categorie = new Category();
            $categorie->setName($value['name']);
            $categorie->setSlug($value['slug']);

            $manager->persist($categorie);
            foreach ($value['subCategories'] as $subcat){
                $subcategorie = new Category();
                $subcategorie->setName($subcat['name']);
                $subcategorie->setSlug($subcat['slug']);
                $subcategorie->setParent($categorie);
                $manager->persist($subcategorie);
            }
            // Enregistre la caegorie dans une référence qui sera utilisé pour les ad textuals
            $this->addReference('category_'. $key, $categorie);
        }

        $manager->flush();
    }
}
