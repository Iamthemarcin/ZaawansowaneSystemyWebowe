<?php

namespace App\Entity\Client;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CompanyName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CompanyNipNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ClientStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(?string $CompanyName): self
    {
        $this->CompanyName = $CompanyName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getCompanyNipNumber(): ?int
    {
        return $this->CompanyNipNumber;
    }

    public function setCompanyNipNumber(?int $CompanyNipNumber): self
    {
        $this->CompanyNipNumber = $CompanyNipNumber;

        return $this;
    }

    public function getClientStatus(): ?bool
    {
        return $this->ClientStatus;
    }

    public function setClientStatus(?bool $ClientStatus): self
    {
        $this->ClientStatus = $ClientStatus;

        return $this;
    }
}
