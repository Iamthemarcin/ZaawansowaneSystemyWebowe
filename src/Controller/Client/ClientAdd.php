<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientAdd extends AbstractController
{
    public function index()
    {
        return $this->render('client/client_add.html.twig');
    }
}