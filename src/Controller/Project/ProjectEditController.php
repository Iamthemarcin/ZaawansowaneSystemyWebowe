<?php
namespace App\Controller\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectEditController extends AbstractController{

    function index(){
        return $this->render('@Project/project_edit.html.twig');
    }
}
