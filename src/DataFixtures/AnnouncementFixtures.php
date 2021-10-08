<?php

namespace App\DataFixtures;

use App\Entity\PackageAdTextual;
use DateInterval;
use App\Entity\Announcement;
use App\Entity\Picture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class AnnouncementFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    { 
        $faker = Faker\Factory::create('fr_CH');


        $nbrj = 15;$prixJ=5.9;$percent=0.9;
        for($nbPack = 1; $nbPack <= 6; $nbPack++){
            $pack = new PackageAdTextual();
            $pack->setNbrDays($nbrj);
            $pack->setPricePerDay($prixJ * $percent);
            $pack->setType(1);
            $pack->setName('Custom pack'. rand(1,5));
            $manager->persist($pack);
            $nbrj = $nbrj + 5;
            dump($prixJ);
            $percent = $percent - 0.05;
        }

        $nbrj = 15;$prixJ=4.9;$percent=0.9;
        for($nbPack = 1; $nbPack <= 6; $nbPack++){
            $pack = new PackageAdTextual();
            $pack->setNbrDays($nbrj);
            $pack->setPricePerDay($prixJ * $percent);
            $pack->setType(2);
            $pack->setName('Custom pack'. rand(1,5));
            $manager->persist($pack);
            $nbrj = $nbrj + 5;
            dump($prixJ);
            $percent = $percent - 0.05;
        }

        $nbrj = 15;$prixJ=3.9;$percent=0.9;
        for($nbPack = 1; $nbPack <= 6; $nbPack++){
            $pack = new PackageAdTextual();
            $pack->setNbrDays($nbrj);
            $pack->setPricePerDay($prixJ * $percent);
            $pack->setType(3);
            $pack->setName('Custom pack'. rand(1,5));
            $manager->persist($pack);
            $nbrj = $nbrj + 5;
            dump($prixJ);
            $percent = $percent - 0.05;
        }

        $idcat = 1;
        for($NbAdversing = 1; $NbAdversing <= 900; $NbAdversing++){
            $idcat = ($idcat < 8 ? $idcat + 1 : 1);
            $from   = new \DateTime();
            $from->modify('-1 day');
            //$from->add(new DateInterval('P' .$NbAdversing. 'D'));
                
            $to   = new \DateTime();
            $to->add(new DateInterval('P' .rand(10,20). 'D'));

            $category = $this->getReference('category_' . $idcat);
            $user = $this->getReference('user_' . '1');
            
            $annoncement = new Announcement();
            $annoncement->setTitle($faker->realText(25));

            $discount = rand(0,50);
            if ($discount == 25) {
                $annoncement->setDiscount('');
            } else {
                $annoncement->setDiscount(rand(0,99));
            }
            
            $annoncement->setShortDescription($faker->realText(70));
            $annoncement->setLongDescription($faker->realText(500));

            $annoncement->setCategory($category);
            $annoncement->setUsers($user);
            $annoncement->setStartAt($from);
            $annoncement->setEndAt($to);
            $annoncement->setIsVerified('1');
            $annoncement->setOptions(rand(0,2));

            for($photo = 1; $photo <= rand(1,6); $photo++){

                $img = new Picture();
                $img->setName('1.jpg');
                $img->setPosition($photo);
                $img->setAlt('toto');
                $img->setAnnouncement($annoncement);

                $manager->persist($img);
            }
            $manager->persist($annoncement);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UsersFixtures::class,
        ];
    }
}
