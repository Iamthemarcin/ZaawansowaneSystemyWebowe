<?php


namespace App\Builder;


use App\DTO\Form\ClientAddDTO;
use App\DTO\Form\ClientAddDTOAddDTO;
use App\DTO\Form\ClientEditDTO;
use App\Entity\Client\ClientEntity;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    public function createFromEditDTO(ClientEntity $currentClient, ClientEditDTO $dto): ClientEntity
    {
        $currentClient->setCompanyName($dto->getCompanyName());
        $currentClient->setCompanyNipNumber($dto->getCompanyNipNumber());
        return $currentClient;
    }

}