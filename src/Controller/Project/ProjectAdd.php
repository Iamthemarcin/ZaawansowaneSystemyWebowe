<?php
namespace App\Controller\Project;

use App\Entity\Project\Project;
use App\Form\Project\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ProjectAdd extends AbstractController{

    function index(){
        return $this->render('@Project/project_add.html.twig');
    }

    function addProject(Request $request)
    {
        $project = new Project();
        $project->setCreationDate(new \DateTime('now'));
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->render('@Project/project_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}