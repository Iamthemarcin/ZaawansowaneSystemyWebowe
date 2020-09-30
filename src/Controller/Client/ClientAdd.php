<?php

namespace App\Controller\Client;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Client\Client;


class ClientAdd extends AbstractController
{
    public function index()
    {
        return $this->render('client/client_add.html.twig');
    }

    public function addClient(Request $request)
    {

        dump($request->getContent());
        $CompanyName = $request->request->get('CompanyName');
        $Email= $request->request->get('Email');
        $CompanyNipNumber = $request->request->get('CompanyNipNumber');


        $entityManager = $this->getDoctrine()->getManager();
        $client = new Client();
        $client->setCompanyName($CompanyName);
        $client->setEmail($Email);
        $client->setCompanyNipNumber($CompanyNipNumber);

        $entityManager->persist($client);
        $entityManager->flush();

        return $this->render('client/client_add.html.twig');
    }
}
