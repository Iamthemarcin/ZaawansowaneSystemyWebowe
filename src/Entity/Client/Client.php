<?php

namespace App\Entity\Client;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(options={"auto_increment": 1})
 */

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $companyNipNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $clientStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCompanyNipNumber(): ?int
    {
        return $this->companyNipNumber;
    }

    public function setCompanyNipNumber(?int $companyNipNumber): self
    {
        $this->companyNipNumber = $companyNipNumber;

        return $this;
    }

    public function getClientStatus(): ?bool
    {
        return $this->clientStatus;
    }

    public function setClientStatus(?bool $clientStatus): self
    {
        $this->clientStatus = $clientStatus;

        return $this;
    }
}
