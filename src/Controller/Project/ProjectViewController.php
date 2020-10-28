<?php
namespace App\Controller\Project;

use App\Entity\Project\ProjectEntity;
use App\Entity\ProjectTest\MinuteTestEntity;
use App\Entity\ProjectTest\SpeedTestEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



class ProjectViewController extends AbstractController{

    private EntityManagerInterface $em;

    function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function index(ProjectEntity $projects, EntityManagerInterface $em){

        $links =$projects->getLinks()->toArray();

        return $this->render('@Project/project_view.html.twig',
            ['project'=>$projects,
            'links'=>$links]);
    }


    public function ajaxAction(Request $request) {
        $minTest = $this->getDoctrine()
            ->getRepository(MinuteTestEntity::class)
            ->findAll();

            return new JsonResponse($minTest);
    }

    public function ajaxActionSpeed(Request $request) {
        $speedTest = $this->getDoctrine()
            ->getRepository(SpeedTestEntity::class)
            ->findAll();

        return new JsonResponse($speedTest);
    }
}





