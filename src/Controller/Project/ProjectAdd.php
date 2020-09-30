<?php
namespace App\Controller\Project;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProjectAdd extends AbstractController{

    function index(){
        return $this->render('project/project_add.html.twig');
    }

    function addProject(Request $request){
        dump($request->getContent());




        return $this->render('project/project_add.html.twig');
    }
}