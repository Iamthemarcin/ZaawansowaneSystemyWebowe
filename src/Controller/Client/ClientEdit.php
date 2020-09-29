<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientEdit extends AbstractController
{
  public function index()
  {
    return $this->render('client/client_edit.html.twig');
  }
}