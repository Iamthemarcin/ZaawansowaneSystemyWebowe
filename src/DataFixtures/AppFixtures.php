<?php

namespace App\DataFixtures;

use App\Entity\Client\ClientEntity;
use App\Entity\Links;
use App\Entity\Project\ProjectEntity;
use App\Entity\ProjectTest\MinuteTestEntity;
use App\Entity\ProjectTest\SpeedTestEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

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
        $mintest2_3->setDateTime(new \DateTime("2020-09-26 21:09:40"));
        $mintest2_3->setLinkId(2);
        $mintest2_3->setProjectId(1);
        $mintest2_3->setStatus(1);

        $mintest2_4= new MinuteTestEntity();
        $mintest2_4->setDateTime(new \DateTime("2020-09-26 21:10:40"));
        $mintest2_4->setLinkId(2);
        $mintest2_4->setProjectId(1);
        $mintest2_4->setStatus(1);

        $mintest2_5= new MinuteTestEntity();
        $mintest2_5->setDateTime(new \DateTime("2020-09-26 21:11:40"));
        $mintest2_5->setLinkId(2);
        $mintest2_5->setProjectId(1);
        $mintest2_5->setStatus(1);

        $client1 = new ClientEntity();
        $client1->setCompanyName('FirmaTestowa');
        $client1->setCompanyNipNumber(1234567890);
        $client1->setClientStatus(true);
        $client1->setEmail('klient@test.com');

        $project1 = new ProjectEntity();
        $project1->setClient('client1');
        $project1->setDayTest(true);
        $project1->setDomain('http://www.project.com');
        $project1->setMinuteTest(true);
        $project1->setStatus(true);
        $project1->setType('TestType');
        $project1->setUpdateTest(true);

        $link1 = new Links();
        $link1->setLink('http://www.superlink.com');
        $link1->setProject($project1);



        $speedtest1_1 = new SpeedTestEntity();
        $speedtest1_1->setProjectId(1);
        $speedtest1_1->setLinkId(1);
        $speedtest1_1->setDateTime(new \DateTime("2020-09-26 21:11:40"));
        $speedtest1_1->setMobileAvg(321);
        $speedtest1_1->getDesktopAvg(123);

        $speedtest1_2 = new SpeedTestEntity();
        $speedtest1_2->setProjectId(1);
        $speedtest1_2->setLinkId(1);
        $speedtest1_2->setDateTime(new \DateTime("2020-09-27 9:11:40"));
        $speedtest1_2->setMobileAvg(154);
        $speedtest1_2->getDesktopAvg(543);

        $speedtest1_3 = new SpeedTestEntity();
        $speedtest1_3->setProjectId(1);
        $speedtest1_3->setLinkId(1);
        $speedtest1_3->setDateTime(new \DateTime("2020-09-27 21:11:40"));
        $speedtest1_3->setMobileAvg(342);
        $speedtest1_3->getDesktopAvg(321);

        $speedtest1_4 = new SpeedTestEntity();
        $speedtest1_4->setProjectId(1);
        $speedtest1_4->setLinkId(1);
        $speedtest1_4->setDateTime(new \DateTime("2020-09-28 9:11:40"));
        $speedtest1_4->setMobileAvg(531);
        $speedtest1_4->getDesktopAvg(123);



        $speedtest2_1 = new SpeedTestEntity();
        $speedtest2_1->setProjectId(1);
        $speedtest2_1->setLinkId(2);
        $speedtest2_1->setDateTime(new \DateTime("2020-09-24 10:11:40"));
        $speedtest2_1->setMobileAvg(432);
        $speedtest2_1->getDesktopAvg(412);

        $speedtest2_2= new SpeedTestEntity();
        $speedtest2_2->setProjectId(1);
        $speedtest2_2->setLinkId(2);
        $speedtest2_2->setDateTime(new \DateTime("2020-09-24 22:11:40"));
        $speedtest2_2->setMobileAvg(354);
        $speedtest2_2->getDesktopAvg(353);

        $speedtest2_3 = new SpeedTestEntity();
        $speedtest2_3->setProjectId(1);
        $speedtest2_3->setLinkId(2);
        $speedtest2_3->setDateTime(new \DateTime("2020-09-25 10:11:40"));
        $speedtest2_3->setMobileAvg(465);
        $speedtest2_3->getDesktopAvg(474);

        $speedtest2_4 = new SpeedTestEntity();
        $speedtest2_4->setProjectId(1);
        $speedtest2_4->setLinkId(2);
        $speedtest2_4->setDateTime(new \DateTime("2020-09-25 22:11:40"));
        $speedtest2_4->setMobileAvg(462);
        $speedtest2_4->getDesktopAvg(342);

        $speedtest2_5 = new SpeedTestEntity();
        $speedtest2_5->setProjectId(1);
        $speedtest2_5->setLinkId(2);
        $speedtest2_5->setDateTime(new \DateTime("2020-09-26 10:11:40"));
        $speedtest2_5->setMobileAvg(214);
        $speedtest2_5->getDesktopAvg(134);


        $manager->persist($mintest1_1);
        $manager->persist($mintest1_2);
        $manager->persist($mintest1_3);
        $manager->persist($mintest1_4);
        $manager->persist($mintest2_1);
        $manager->persist($mintest2_2);
        $manager->persist($mintest2_3);
        $manager->persist($mintest2_4);
        $manager->persist($mintest2_5);
        $manager->persist($speedtest1_1);
        $manager->persist($speedtest1_2);
        $manager->persist($speedtest1_3);
        $manager->persist($speedtest1_4);
        $manager->persist($speedtest2_1);
        $manager->persist($speedtest2_2);
        $manager->persist($speedtest2_3);
        $manager->persist($speedtest2_4);
        $manager->persist($speedtest2_5);
        $manager->persist($client1);
        $manager->persist($project1);
        $manager->persist($link1);
        $manager->flush();
    }
}
