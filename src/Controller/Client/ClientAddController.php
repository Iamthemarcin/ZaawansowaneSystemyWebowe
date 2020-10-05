<?php

namespace App\Controller\Client;

use App\Form\Client\ClientAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ClientAddController extends AbstractController
{
    function index(Request $request){
            $form = $this->createForm(ClientAddType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {


                dd($form->getData());
                return $this->redirectToRoute("client_add");
            }

            return $this->render('@Client/client_add.html.twig', [
                'form' => $form->createView(),
            ]);

    }
}
