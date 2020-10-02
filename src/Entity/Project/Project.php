<?php

namespace App\Entity\Project;

use App\Entity\Base\Base;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project extends Base
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
    private $domain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $minuteTest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $speedTest;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $updateTest;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMinuteTest(): ?bool
    {
        return $this->minuteTest;
    }

    public function setMinuteTest(?bool $minuteTest): self
    {
        $this->minuteTest = $minuteTest;

        return $this;
    }

    public function getSpeedTest(): ?bool
    {
        return $this->speedTest;
    }

    public function setSpeedTest(?bool $speedTest): self
    {
        $this->speedTest = $speedTest;

        return $this;
    }

    public function getUpdateTest(): ?bool
    {
        return $this->updateTest;
    }

    public function setUpdateTest(?bool $updateTest): self
    {
        $this->updateTest = $updateTest;

        return $this;
    }
}
