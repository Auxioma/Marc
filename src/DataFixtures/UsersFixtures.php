<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        
        $user = new Users();
        $user->setEmail('guillaume@free.fr');
        $user->setPassword($this->encoder->encodePassword($user, '123456789'));
        $user->setIsVerified('1');
        $user->setPhoneNumber('+33 7 66 06 80 09');
        $user->setCompagny('auxioma');
        $user->setName('yoyo');
        $user->setFirstName('yaya');
        $user->setAddress('14 rue toto');
        $user->setCodePost('77000');
        $user->setDepartment('Savoie');
        $user->setPicture('1.jpg');
        $user->setCity('Geneve');
        
        $manager->persist($user);

        $this->addReference('user_'. '1', $user);

        $manager->flush();
    }
}
