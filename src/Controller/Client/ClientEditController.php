<?php

namespace App\Controller\Client;

use App\Builder\ClientBuilder;
use App\DTO\Form\ClientAddDTO;
use App\Entity\Client\ClientEntity;
use App\Factory\ClientFactory;
use App\Form\Client\ClientAddType;
use App\Form\Client\ClientEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;




class ClientEditController extends AbstractController
{
    private EntityManagerInterface $em;
    private ClientBuilder $clientBuilder;
    private ClientFactory $clientFactory;

    public function __construct(

        EntityManagerInterface $em,
        ClientBuilder $clientBuilder,
        ClientFactory $clientFactory
    ){
        $this->clientBuilder = $clientBuilder;
        $this->clientFactory = $clientFactory;
        $this->em = $em;
    }




    public function index(ClientEntity $client, Request $request){

        $form = $this->createForm(
            ClientEditType::class,
            $this->clientFactory->createFromEditClient($client)
        );
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            /** @var ClientAddDTO $dto */
            $dto = $form->getData();

            try {
                $client = $this->clientBuilder->createFromEditDTO($client, $dto);
                $this->em->persist($client);
                $this->em->flush();

                $this->addFlash('successEdit','Zedytowano klienta!');
            } catch (\Exception $e) {
                dump($e->getMessage());
            }


            return $this->redirectToRoute("client_list");
        }


        $errors = $form->getErrors(true, false);


        return $this->render('@Client/client_edit.html.twig', [
            'form' => $form->createView(),
            #WALIDACJA
            'errors' => $errors,
            'client' => $client
        ]);

    }
}