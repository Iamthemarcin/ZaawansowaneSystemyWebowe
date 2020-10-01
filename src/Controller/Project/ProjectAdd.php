<?php
namespace App\Controller\Project;

use App\Entity\Project\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProjectAdd extends AbstractController{

    function index(){
        return $this->render('@Project/project_add.html.twig');
    }

    function addProject(Request $request){
        dump($request->getContent());
        $domain = $request->request->get('domain');
        $client= $request->request->get('client');
        $type = $request->request->get('type');
        $status = $request->request->get('custom-inline-radio-right');

        $entityManager = $this->getDoctrine()->getManager();
        $project = new Project();
        $project->setDomain($domain);
        $project->setClient($client);
        $project->setType($type);
        $project->setStatus($status);

        $entityManager->persist($project);


        $entityManager->flush();


        return $this->render('@Project/project_add.html.twig');
    }
}