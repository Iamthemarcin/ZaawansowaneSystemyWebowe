<?php
namespace App\Controller\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectAdd extends AbstractController{

    function index(){
        return $this->render('project/project_add.html.twig');
    }
}
