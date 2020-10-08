<?php
namespace App\Controller\Project;

use App\Entity\Project\ProjectEntity;
use App\Entity\ProjectTest\SpeedTestEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectViewController extends AbstractController{

    private EntityManagerInterface $em;

    function __construct(EntityManagerInterface $em){
        $this->em = $em;

    }

    function index(ProjectEntity $projects, EntityManagerInterface $em){
        $em->createQuery($query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = 1'));
        $test_count = count($query->getResult());
        dd($test_count);

        return $this->render('project/project_view.html.twig',['project'=>$projects,'test_count'=>$test_count]);

    }
}
