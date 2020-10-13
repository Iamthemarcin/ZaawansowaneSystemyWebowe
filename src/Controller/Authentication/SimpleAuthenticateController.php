<?php

namespace App\Controller\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SimpleAuthenticateController extends AbstractController
{
  public function login(Request $request ,AuthenticationUtils $authenticationUtils)
  {


    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }
  
  public function logout()
  {}
}