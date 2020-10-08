<?php
namespace App\Controller\Project;

use App\Entity\Project\ProjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectViewController extends AbstractController{


    function index(ProjectEntity $projects){


        return $this->render('project/project_view.html.twig',['project'=>$projects]);

    }
}
