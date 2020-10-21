<?php
namespace App\Controller\Project;

use App\Entity\Links;
use App\Entity\Project\ProjectEntity;
use App\Entity\ProjectTest\MinuteTestEntity;
use App\Entity\ProjectTest\SpeedTestEntity;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
                    dump($time_diff);
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

    public function interval_to_seconds(DateInterval $dateInterval){
        $years = $dateInterval->y;
        $months = $dateInterval->m * + $years * 12;
        $days = $dateInterval->d+ $months*30;
        $hours = $dateInterval->h + $days* 24;
        $minutes = $dateInterval->i + $hours * 60;
        $seconds = $dateInterval->s + $minutes * 60;

        return $seconds;
    }

#TU PRZECHODZISZ Z ID LINKU TESTU
    public function from_link(ProjectEntity $projects, EntityManagerInterface $em, Links $link)
{
        $link_id = $link->getId();
        $id = $projects->getId();
        $links =$projects->getLinks()->toArray();

##RZECZY DO TESTU BADANIA SZYBKOSCI

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id' )->setParameters(["id" => $id,"link_id" => $link_id]);
        $speed_test_logs = ($query->getResult());


        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id' )->setParameters(["id" => $id,"link_id" => $link_id]);
        $test_count = count($query->getResult());


        $query = $em->createQuery('SELECT MIN(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id' )->setParameters(["id" => $id,"link_id" => $link_id]);
        $min_avg = $query->getResult()[0][1];

        $query = $em->createQuery('SELECT AVG(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id')->setParameters(["id" => $id,"link_id" => $link_id]);
        $avg_avg = round($query->getResult()[0][1],2);

        $query = $em->createQuery('SELECT MAX(u.desktopAvg) FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id')->setParameters(["id" => $id,"link_id" => $link_id]);
        $max_avg =  $query->getResult()[0][1];

        $speed_test_arr = ["test_count" => $test_count,
            'min_avg' => $min_avg,
            'avg_avg' => $avg_avg,
            'max_avg' => $max_avg];

##RZECZY DO TESTU MINUTOWEGO

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id' )->setParameters(["id" => $id,"link_id" => $link_id]);
        $minute_test_logs = ($query->getResult());

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id AND u.linkId = :link_id')->setParameters(["id" => $id,"link_id" => $link_id]);
        $minute_test_count = count($query->getResult());


        $ActiveTime = $this->calculating_time(1,$id,$link_id);

        $ActiveTimeSeconds = $this->interval_to_seconds($ActiveTime);
        $ActiveTime = $ActiveTime-> format('%d dni %h godz %i min %s sek');


        $InactiveTime = $this->calculating_time(0,$id,$link_id);
        $InactiveTimeSeconds = $this->interval_to_seconds($InactiveTime);
        $InactiveTime = $InactiveTime-> format('%d dni %h godzin %i minut %s sekund');



        if($ActiveTimeSeconds != 0 || $InactiveTimeSeconds != 0){
            $Percent_active_time = round($ActiveTimeSeconds / ($ActiveTimeSeconds + $InactiveTimeSeconds) * 100, 2);
            $Percent_inactive_time = round($InactiveTimeSeconds / ($InactiveTimeSeconds + $ActiveTimeSeconds) * 100, 2);}


        else{
            $Percent_active_time = 'brak danych';
            $Percent_inactive_time = 'brak danych';
        }



        $minute_test_arr = ["minute_test_count" => $minute_test_count,
            'ActiveTime' => $ActiveTime,
            'InactiveTime' => $InactiveTime,
            'Percent_active_time' => $Percent_active_time,
            'Percent_inactive_time' =>$Percent_inactive_time
        ];

        return $this->render('@Project/project_view.html.twig',
            ['project'=>$projects,
                'speed_test_logs' => $speed_test_logs,
                'speed_test_arr' =>  $speed_test_arr,
                'minute_test_logs' => $minute_test_logs,
                'minute_test_arr' => $minute_test_arr,
                'links'=>$links]);
}













#TU PRZECHODZISZ Z LISTY PROJEKTOW, JAK NIE MASZ LINKU
    public function index(ProjectEntity $projects, EntityManagerInterface $em){

        $id = $projects->getId();
        $links =$projects->getLinks()->toArray();

##RZECZY DO TESTU BADANIA SZYBKOSCI

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\SpeedTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);;
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

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);;
        $minute_test_logs = ($query->getResult());

        $query = $em->createQuery('SELECT u FROM App\Entity\ProjectTest\MinuteTestEntity u WHERE u.projectId = :id')->setParameter("id", $id);
        $minute_test_count = count($query->getResult());


        $ActiveTime = $this->calculating_time(1,$id);
        dump($ActiveTime);
        $ActiveTimeSeconds = $this->interval_to_seconds($ActiveTime);
        $ActiveTime = $ActiveTime-> format('%d dni %h godz %i min %s sek');


        $InactiveTime = $this->calculating_time(0,$id);

        $InactiveTimeSeconds = $this->interval_to_seconds($InactiveTime);
        $InactiveTime = $InactiveTime-> format('%d dni %h godzin %i minut %s sekund');



        if($ActiveTimeSeconds != 0 || $InactiveTimeSeconds != 0){
            $Percent_active_time = round($ActiveTimeSeconds / ($ActiveTimeSeconds + $InactiveTimeSeconds) * 100, 2);
            $Percent_inactive_time = round($InactiveTimeSeconds / ($InactiveTimeSeconds + $ActiveTimeSeconds) * 100, 2);}


            else{
                $Percent_active_time = 'brak danych';
                $Percent_inactive_time = 'brak danych';
            }



        $minute_test_arr = ["minute_test_count" => $minute_test_count,
            'ActiveTime' => $ActiveTime,
            'InactiveTime' => $InactiveTime,
            'Percent_active_time' => $Percent_active_time,
            'Percent_inactive_time' =>$Percent_inactive_time
        ];

        return $this->render('@Project/project_view.html.twig',
            ['project'=>$projects,
            'speed_test_logs' => $speed_test_logs,
            'speed_test_arr' =>  $speed_test_arr,
            'minute_test_logs' => $minute_test_logs,
            'minute_test_arr' => $minute_test_arr,
            'links'=>$links]);
    }


    public function ajaxAction(Request $request) {
        $minTest = $this->getDoctrine()
            ->getRepository(MinuteTestEntity::class)
            ->findAll();

            return new JsonResponse($minTest);
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

