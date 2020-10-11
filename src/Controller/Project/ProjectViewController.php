<?php
namespace App\Controller\Project;

use App\Entity\Project\ProjectEntity;
use App\Entity\ProjectTest\SpeedTestEntity;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProjectViewController extends AbstractController{

    private EntityManagerInterface $em;




    function __construct(EntityManagerInterface $em){
        $this->em = $em;


    }

    public function calculating_time(EntityManagerInterface $em, $status){


        $q = $em->createQuery('select u from App\Entity\ProjectTest\MinuteTestEntity u');
        $iterableResult = $q->iterate();

        $prev_row = null;
        $prev_date = null;
        $diff = null;

        $now = new DateTime();
        $time_diff = new DateTime('2010-01-01 T00:00:00');
        $compare_to = new DateTime('2010-01-01 T00:00:00');
        $numItems = count($q->getScalarResult());




        foreach ($iterableResult as $row) {

            $curr_row_date = ($row[0]->getDateTime());

            if ($prev_date !== null) {
                $diff = date_diff($prev_date, $curr_row_date);}

            if ($prev_row !== null) {
                if ($prev_row[0]->getStatus() == 1) {
                    $time_diff->add($diff);
                }
            };

            if ($row[0]->getId() == $numItems){

                if($row[0]->getStatus() == 1){
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

        $id = $projects->getId();
        $links =$projects->getLinks()->toArray();



##RZECZY DO TESTU BADANIA SZYBKOSCI

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u');
        $speed_test_logs = ($query->getResult());

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $test_count = count($query->getResult());

        $query = $em->createQuery('SELECT MIN(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $min_avg = $query->getResult()[0][1];

        $query = $em->createQuery('SELECT AVG(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $avg_avg = round($query->getResult()[0][1],2);

        $query = $em->createQuery('SELECT MAX(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $max_avg =  $query->getResult()[0][1];

        $speed_test_arr = ["test_count" => $test_count,
            'min_avg' => $min_avg,
            'avg_avg' => $avg_avg,
            'max_avg' => $max_avg];

##RZECZY DO TESTU MINUTOWEGO

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u');
        $minute_test_logs = ($query->getResult());

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $test_count = count($query->getResult());



        $prev_row = null;
        $prev_date = null;
        $diff = null;
        $numItems = count($query->getScalarResult());

        $now = new DateTime();
        $time_diff = new DateTime('2010-01-01 T00:00:00');
        $compare_to = new DateTime('2010-01-01 T00:00:00');

        $q = $em->createQuery('select u from App\Entity\ProjectTest\MinuteTestEntity u');
        $iterableResult = $q->iterate();

        foreach ($iterableResult as $row) {

            $curr_row_date = ($row[0]->getDateTime());

            if ($prev_date !== null) {
                $diff = date_diff($prev_date, $curr_row_date);}

            if ($prev_row !== null) {
                if ($prev_row[0]->getStatus() == 1) {
                    $time_diff->add($diff);
                    dump($time_diff,$compare_to);
                    dump($diff);
                }
            };

            if ($row[0]->getId() == $numItems){

                if($row[0]->getStatus() == 1){
                    $diff = date_diff($curr_row_date, $now);
                    $time_diff->add($diff);
                    dump($time_diff,$compare_to);
                    dump($diff);
                }
            }


            $prev_date = $curr_row_date;
            $prev_row = $row;
        }
//        dump($time_diff,$compare_to);
//        dump(date_diff($compare_to,$time_diff));
//        die();
//            dd($links[0]);







        return $this->render('project/project_view.html.twig',
            ['project'=>$projects,
            'speed_test_logs' => $speed_test_logs,
            'speed_test_arr' =>  $speed_test_arr,
            'minute_test_logs' => $minute_test_logs,
            'links'=>$links]);
    }
}




//SELECT
//      id,
//      status,
//      date_time,
//      (LEAD(date_time) OVER (ORDER BY date_time)  - date_time
//                )AS datediff
//FROM    minute_test_entity
//WHERE project_id = 1 ORDER BY date_time;