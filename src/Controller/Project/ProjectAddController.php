<?php
namespace App\Controller\Project;

use App\Entity\Project\Project;
use App\Form\Project\ProjectAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ProjectAddController extends AbstractController{

    function index(Request $request){
        $form = $this->createForm(ProjectAddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
            return $this->redirectToRoute("project_add");

        }
        return $this->render('@Project/project_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}