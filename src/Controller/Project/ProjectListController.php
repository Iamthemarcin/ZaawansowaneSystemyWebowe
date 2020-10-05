<?php
 namespace App\Controller\Project;

 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use App\DTO\Form\ProjectAddDTO;

 class ProjectListController extends AbstractController{

     public function index(){
         $projects = $this->getDoctrine()->getRepository
         ( ProjectAddDTO::class)->findAll();
         return $this->render('@Project/project_list.html.twig',['projects'=>$projects]);


     }
 }