<?php

namespace App\Controller\Client;

use App\Builder\ClientBuilder;
use App\DTO\Form\ClientAddDTO;
use App\Entity\Client\ClientEntity;
use App\Form\Client\ClientAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClientAddController extends AbstractController
{
    private EntityManagerInterface $em;
    private ClientBuilder $clientBuilder;

    public function __construct(
        EntityManagerInterface $em,
        ClientBuilder $clientBuilder
    ){
        $this->clientBuilder = $clientBuilder;
        $this->em = $em;
    }




    public function index(Request $request){

            $form = $this->createForm(ClientAddType::class);
            $form->handleRequest($request);
            $dto = $form->getData();



            if ($form->isSubmitted() && $form->isValid()) {

                /** @var ClientAddDTO $dto */

                try {
                    $newClient = $this->clientBuilder->createFromDTO($dto);




                    $this->em->persist($newClient);

                    $this->em->flush();


                    $this->addFlash('success','Dodano klienta!');


                } catch (\Exception $e) {
                    dump($e->getMessage());
                }


                return $this->redirectToRoute("client_add");
            }
            $errors = $form->getErrors(true, false);

            return $this->render('@Client/client_add.html.twig', [
                'form' => $form->createView(),
                #WALIDACJA
                'errors' => $errors,

            ]);

    }
}

