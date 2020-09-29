<?php

namespace App\Controller\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SimpleAuthenticateController extends AbstractController
{
  public function login(AuthenticationUtils $authenticationUtils)
  {
    if ($this->getUser()) {
       return $this->redirectToRoute('home');
    }
    
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    
    return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }
  
  public function logout()
  {}
}