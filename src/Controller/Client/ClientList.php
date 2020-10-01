<?php

namespace App\Controller\Client;

use App\Entity\Client\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientList extends AbstractController
{
    public function index()
    {

        $clients = $this->getDoctrine()->getRepository
        (Client::class)->findAll();
        return $this->render('client/client_list.html.twig',array('clients'=>$clients));
    }
}