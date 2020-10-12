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

    public function calculating_time($status):DateInterval{

        $em = $this->em;
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
                if ($prev_row[0]->getStatus() == $status) {
                    $time_diff->add($diff);
                }
            }

            if ($row[0]->getId() == $numItems){

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

    public function interval_to_seconds(DateInterval $d){

        $months = $d->y * 12;
        $days = $d->m+$months*30;
        $hours = $d->h + $days* 24;
        $minutes = $d->i + $hours * 60;
        $seconds = $d->s + $minutes * 60;

        return $seconds;


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
        $minute_test_count = count($query->getResult());


        $ActiveTime = $this->calculating_time(1);
        $ActiveTimeSeconds = $this->interval_to_seconds($ActiveTime);
        $ActiveTime = $ActiveTime-> format('%d dni %h godz %i min %s sek');


        $InactiveTime = $this->calculating_time(0);
        $InactiveTimeSeconds = $this->interval_to_seconds($InactiveTime);
        $InactiveTime = $InactiveTime-> format('%d dni %h godzin %i minut %s sekund');

        if($ActiveTimeSeconds != 0 || $InactiveTimeSeconds != 0){
            $Percent_active_time = round($ActiveTimeSeconds / ($ActiveTimeSeconds + $InactiveTimeSeconds) * 100, 2);
            $Percent_inactive_time = round($InactiveTimeSeconds / ($InactiveTimeSeconds + $ActiveTimeSeconds) * 100, 2);}


            else{
                $Percent_active_time = 'we cos wrzuc mordo';
                $Percent_inactive_time = 'we cos wrzuc mordo';
            }




        $minute_test_arr = ["minute_test_count" => $minute_test_count,
            'ActiveTime' => $ActiveTime,
            'InactiveTime' => $InactiveTime,
            'Percent_active_time' => $Percent_active_time,
            'Percent_inactive_time' =>$Percent_inactive_time
        ];






        return $this->render('project/project_view.html.twig',
            ['project'=>$projects,
            'speed_test_logs' => $speed_test_logs,
            'speed_test_arr' =>  $speed_test_arr,
            'minute_test_logs' => $minute_test_logs,
            'minute_test_arr' => $minute_test_arr,
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