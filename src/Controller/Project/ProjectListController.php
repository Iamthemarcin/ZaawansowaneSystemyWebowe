<?php
 namespace App\Controller\Project;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use App\Entity\Project\Project;

 class ProjectListController extends AbstractController{

     public function index(){
         $projects = $this->getDoctrine()->getRepository
         (Project::class)->findAll();
         return $this->render('@Project/project_list.html.twig',['projects'=>$projects]);


     }
 }