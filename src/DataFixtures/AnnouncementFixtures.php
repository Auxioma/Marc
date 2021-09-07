<?php

namespace App\DataFixtures;

use DateInterval;
use App\Entity\Announcement;
use App\Entity\Picture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnnouncementFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    { 


        for($NbAdversing = 1; $NbAdversing <= 999; $NbAdversing++){
            
            $from   = new \DateTime();
            $from->add(new DateInterval('P' .$NbAdversing. 'D'));
                
            $to   = new \DateTime();
            $to->add(new DateInterval('P' .rand(10,20). 'D'));

            $category = $this->getReference('category_' . random_int(0, 8));    
            $user = $this->getReference('user_' . '1');
            
            $annoncement = new Announcement();
            $annoncement->setTitle('Annonce N° ');
            $annoncement->setDiscount(rand(0,99));
            $annoncement->setShortDescription('petite description');
            $annoncement->setLongDescription('longue description');
            $annoncement->setCategory($category);
            $annoncement->setUsers($user);
            $annoncement->setStartAt($from);
            $annoncement->setEndAt($to);
            $annoncement->setIsVerified(rand(0,1));
            $annoncement->setOffert(rand(0,4));

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
