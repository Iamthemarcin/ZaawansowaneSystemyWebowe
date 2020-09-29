<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientList extends AbstractController
{
    public function index()
    {
        return $this->render('client/client_list.html.twig');
    }
}