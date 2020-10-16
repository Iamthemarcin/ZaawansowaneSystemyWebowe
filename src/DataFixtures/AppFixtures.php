<?php

namespace App\DataFixtures;

use App\Entity\ProjectTest\MinuteTestEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $mintest1_1= new MinuteTestEntity();
        $mintest1_1->setDateTime(new \DateTime("2020-09-26 21:01:40"));
        $mintest1_1->setLinkId(1);
        $mintest1_1->setProjectId(1);
        $mintest1_1->setStatus(1);

        $mintest1_2= new MinuteTestEntity();
        $mintest1_2->setDateTime(new \DateTime("2020-09-26 21:02:40"));
        $mintest1_2->setLinkId(1);
        $mintest1_2->setProjectId(1);
        $mintest1_2->setStatus(1);

        $mintest1_3= new MinuteTestEntity();
        $mintest1_3->setDateTime(new \DateTime("2020-09-26 21:03:40"));
        $mintest1_3->setLinkId(1);
        $mintest1_3->setProjectId(1);
        $mintest1_3->setStatus(0);

        $mintest1_4= new MinuteTestEntity();
        $mintest1_4->setDateTime(new \DateTime("2020-09-26 21:04:40"));
        $mintest1_4->setLinkId(1);
        $mintest1_4->setProjectId(1);
        $mintest1_4->setStatus(1);


        $mintest2_1= new MinuteTestEntity();
        $mintest2_1->setDateTime(new \DateTime("2020-09-26 21:07:40"));
        $mintest2_1->setLinkId(2);
        $mintest2_1->setProjectId(1);
        $mintest2_1->setStatus(0);

        $mintest2_2= new MinuteTestEntity();
        $mintest2_2->setDateTime(new \DateTime("2020-09-26 21:08:40"));
        $mintest2_2->setLinkId(2);
        $mintest2_2->setProjectId(1);
        $mintest2_2->setStatus(0);

        $mintest2_3= new MinuteTestEntity();
        $mintest2_3->setDateTime(new \DateTime("202-09-26 21:09:40"));
        $mintest2_3->setLinkId(2);
        $mintest2_3->setProjectId(1);
        $mintest2_3->setStatus(1);

        $mintest2_4= new MinuteTestEntity();
        $mintest2_4->setDateTime(new \DateTime("2020-09-26 21:10:40"));
        $mintest2_4->setLinkId(2);
        $mintest2_4->setProjectId(1);
        $mintest2_4->setStatus(1);




        $manager->persist($mintest1_1);
        $manager->persist($mintest1_2);
        $manager->persist($mintest1_3);
        $manager->persist($mintest1_4);
        $manager->persist($mintest2_1);
        $manager->persist($mintest2_2);
        $manager->persist($mintest2_3);
        $manager->persist($mintest2_4);

        $manager->flush();
    }
}
