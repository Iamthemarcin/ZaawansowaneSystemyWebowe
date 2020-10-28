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

    public function calculating_time($status,$projectId,$link = null):DateInterval{

        $id = $projectId;
        $em = $this->em;
        if($link != null){
            $q = $em->createQuery('select u from App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id' )->setParameters(["id" => $id,"link_id" => $link]);
        }
        else{
            $q = $em->createQuery('select u from App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id')->setParameter('id',$id);
        }

        $iterableResult = $q->iterate();

        $prev_row = null;
        $prev_date = null;
        $diff = null;

        $now = new DateTime();
        $time_diff = new DateTime('2010-01-01 T00:00:00');
        $compare_to = new DateTime('2010-01-01 T00:00:00');
        $numItems = count($q->getScalarResult());

        $i = 0;


        foreach ($iterableResult as $row) {
            $curr_row_date = ($row[0]->getDateTime());
            $i += 1;
            if ($prev_date !== null) {
                $diff = date_diff($prev_date, $curr_row_date);}

            if ($prev_row !== null) {
                if ($prev_row[0]->getStatus() == $status) {
                    $time_diff->add($diff);

                }
            }


            if ($i == $numItems){

                if($row[0]->getStatus() == $status){

                    $diff = date_diff($curr_row_date, $now);
                    $time_diff->add($diff);




                }
            }


            $prev_date = $curr_row_date;
            $prev_row = $row;
        }

        date_diff($compare_to,$time_diff);

        return date_diff($compare_to,$time_diff);

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





