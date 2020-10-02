<?php
namespace App\Controller\Project;

use App\Entity\Project\Project;
use App\Form\Project\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ProjectAdd extends AbstractController{



    function index(){
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        return $this->render('@Project/project_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    function addProject(Request $request)
    {


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $project->setCreationDate(new \DateTime('now'));
            $entityManager->persist($project);
            $entityManager->flush();
        }


    }
}