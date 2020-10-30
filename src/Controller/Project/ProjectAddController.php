<?php
namespace App\Controller\Project;

use App\Builder\ProjectBuilder;
use App\DTO\Form\ProjectAddDTO;
use App\Entity\Client\ClientEntity;
use App\Form\Project\ProjectAddType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ProjectAddController extends AbstractController {

    private EntityManagerInterface $em;
    private ProjectBuilder $projectBuilder;

    public function __construct(
        EntityManagerInterface $em,
        ProjectBuilder $projectBuilder
    ){
        $this->projectBuilder = $projectBuilder;
        $this->em = $em;
    }

    public function index(Request $request){
        $form = $this->createForm(ProjectAddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var ProjectAddDTO $dto */
            $dto = $form->getData();


            try {
                $newProject = $this->projectBuilder->createFromDTO($dto);

                $this->em->persist($newProject);
                $this->em->flush();
                $this->addFlash('successAddProject','Dodano projekt!');
            } catch (\Exception $e) {
                dump($e->getMessage());
            }

            return $this->redirectToRoute("project_add");

        }
        $clients = $this->getDoctrine()->getRepository
        (ClientEntity::class)->findAll();

        $errors = $form->getErrors(true, false);

        return $this->render('@Project/project_add.html.twig', [
            'form' => $form->createView(),'clients'=>$clients, 'errors' => $errors
        ]);
    }
}