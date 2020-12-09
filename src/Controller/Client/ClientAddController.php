<?php

namespace App\Controller\Client;

use App\Builder\ClientBuilder;
use App\DTO\Form\ClientAddDTO;
use App\Entity\Client\ClientEntity;
use App\Form\Client\ClientAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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

            $httpClient = HttpClient::create();
            try {
                $response = $httpClient->
                request('GET',
                    'https://joke3.p.rapidapi.com/v1/joke',
                    [
                        'headers' => [
                            'x-rapidapi-key' => 'c8b99395b2msh322953e25c303d8p184f58jsn6570ddee2dfd',
                            'x-rapidapi-host' => 'joke3.p.rapidapi.com'
                        ]
                    ]);
            } catch (TransportExceptionInterface $e) {
            }

            $content = $response->toArray();
            $content = $content['content'];

            $form = $this->createForm(ClientAddType::class);
            $form->handleRequest($request);
            $dto = $form->getData();



            if ($form->isSubmitted() && $form->isValid()) {

                /** @var ClientAddDTO $dto */

                try {
                    $newClient = $this->clientBuilder->createFromDTO($dto);




                    $this->em->persist($newClient);

                    $this->em->flush();


                    $this->addFlash('successAddClient','Dodano klienta!');


                } catch (\Exception $e) {
                    dump($e->getMessage());
                }


                return $this->redirectToRoute("client_add");
            }
            $errors = $form->getErrors(true, false);

            return $this->render('@Client/client_add.html.twig', [
                'form' => $form->createView(),
                'dowcip' => $content,

                #WALIDACJA
                'errors' => $errors,

            ]);

    }
}

