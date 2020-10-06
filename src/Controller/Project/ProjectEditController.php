<?php
namespace App\Controller\Project;

use App\Entity\Client\ClientEntity;
use App\Entity\Project\ProjectEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectEditController extends AbstractController{

    function index(ProjectEntity $project){
        dd($project);







        $clients = $this->getDoctrine()->getRepository
        (ClientEntity::class)->findAll();
        return $this->render('@Project/project_edit.html.twig', [
            'clients'=>$clients
        ]);
    }
}
