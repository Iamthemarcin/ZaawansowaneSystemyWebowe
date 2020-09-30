<?php

namespace App\Entity\Project;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Status;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $MinuteTest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $SpeedTest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $UpdateTest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->Domain;
    }

    public function setDomain(string $Domain): self
    {
        $this->Domain = $Domain;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->Client;
    }

    public function setClient(string $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getMinuteTest(): ?bool
    {
        return $this->MinuteTest;
    }

    public function setMinuteTest(?bool $MinuteTest): self
    {
        $this->MinuteTest = $MinuteTest;

        return $this;
    }

    public function getSpeedTest(): ?bool
    {
        return $this->SpeedTest;
    }

    public function setSpeedTest(?bool $SpeedTest): self
    {
        $this->SpeedTest = $SpeedTest;

        return $this;
    }

    public function getUpdateTest(): ?bool
    {
        return $this->UpdateTest;
    }

    public function setUpdateTest(?bool $UpdateTest): self
    {
        $this->UpdateTest = $UpdateTest;

        return $this;
    }
}
