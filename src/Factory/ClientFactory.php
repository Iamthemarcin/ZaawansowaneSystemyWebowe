<?php


namespace App\Factory;


use App\DTO\Form\ClientEditDTO;
use App\Entity\Client\ClientEntity;

class ClientFactory
{
    public function FromEditClient(ClientEntity $entity): ClientEditDTO
    {
        $client = new ClientEditDTO();
        $client->setCompanyNipNumber($entity->getCompanyNipNumber());
        $client->setCompanyName($entity->getCompanyName());


        return $client;
    }
}