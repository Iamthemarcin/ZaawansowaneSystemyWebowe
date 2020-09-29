<?php
namespace App\Controller\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectView extends AbstractController{

    function index(){
        return $this->render('project/project_view.html.twig');
    }
}
