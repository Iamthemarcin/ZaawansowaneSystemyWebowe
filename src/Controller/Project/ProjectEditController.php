<?php
namespace App\Controller\Project;

use App\Builder\ProjectBuilder;
use App\DTO\Form\ProjectEditDTO;
use App\Entity\Client\ClientEntity;
use App\Entity\Project\ProjectEntity;
use App\Factory\ProjectFactory;
use App\Form\Project\ProjectEditType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProjectEditController extends AbstractController{

    private EntityManagerInterface $em;
    private ProjectBuilder $projectBuilder;
    private ProjectFactory $projectFactory;

    public function __construct(
        EntityManagerInterface $em,
        ProjectBuilder $projectBuilder,
        ProjectFactory $projectFactory
    ){
        $this->projectBuilder = $projectBuilder;
        $this->projectFactory = $projectFactory;
        $this->em = $em;
    }

    function index(ProjectEntity $project, Request $request){

        $form = $this->createForm(
            ProjectEditType::class,
            $this->projectFactory->createFromEditProject($project)
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var ProjectEditDTO $dto*/
            $dto = $form->getData();

            try {
               $project = $this->projectBuilder->createFromEditDTO($project, $dto);

                $this->em->persist($project);
                $this->em->flush();

            } catch (\Exception $e) {
                dump($e->getMessage());
            }

            return $this->redirectToRoute("project_list");

        }



        $clients = $this->getDoctrine()->getRepository
        (ClientEntity::class)->findAll();

        $errors = $form->getErrors(true,false);

        return $this->render('@Project/project_edit.html.twig', ['form' => $form->createView(),
            'clients'=>$clients, 'project'=>$project , 'errors' => $errors
        ]);
    }
}
