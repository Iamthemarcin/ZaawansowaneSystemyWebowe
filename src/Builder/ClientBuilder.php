<?php


namespace App\Builder;


use App\DTO\Form\ClientAddDTO;
use App\DTO\Form\ClientAddDTOAddDTO;
use App\Entity\Client\ClientEntity;

class ClientBuilder
{
    public function createFromDTO(ClientAddDTO $dto): ClientEntity
    {
        $client = new ClientEntity();
        $client->setCompanyNipNumber($dto->getCompanyNipNumber());
        $client->setCompanyName($dto->getCompanyName());
        $client->setEmail($dto->getEmail());
        $client->setClientStatus(1);

        return $client;
    }
}