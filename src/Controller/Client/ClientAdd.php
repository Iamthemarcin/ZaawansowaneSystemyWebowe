<?php

namespace App\Controller\Client;

use http\Env\Response;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client\Client;


class ClientAdd extends AbstractController
{
    public function index()
    {
        return $this->render('client/client_add.html.twig');
    }

    public function addClient(Requgitoest $request)
    {

        dump($request->getContent());
        $companyName = $request->request->get('companyName');
        $email= $request->request->get('email');
        $companyNipNumber = $request->request->get('companyNipNumber');


        $entityManager = $this->getDoctrine()->getManager();
        $client = new Client();
        $client->setCompanyName($companyName);
        $client->setEmail($email);
        $client->setCompanyNipNumber($companyNipNumber);

        $entityManager->persist($client);
        $entityManager->flush();

        return $this->render('client/client_add.html.twig');
    }
}
