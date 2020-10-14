<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;
    public function  __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder =$encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User\User();
        $user->setEmail('test@test.pl');
        $user->setFirstName('Andrzej');
        $user->setLastName('Kowalski');
        $user->setPassword($this->encoder->encodePassword($user,'root'));
        $user->setRoles($user->getRoles());
        $manager->persist($user);

        $manager->flush();
    }
}
