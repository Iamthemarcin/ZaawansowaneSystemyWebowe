<?php
 namespace App\Controller\Project;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 class ProjectList extends AbstractController{

     public function index(){

         return $this->render('project/project_list.html.twig');

     }
 }