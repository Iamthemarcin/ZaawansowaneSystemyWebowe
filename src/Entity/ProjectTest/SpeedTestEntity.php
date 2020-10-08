<?php

namespace App\Entity\ProjectTest;

use App\Repository\SpeedTestEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpeedTestEntityRepository::class)
 */
class SpeedTestEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $projectId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $linkId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobileAvg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $desktopAvg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $JSON;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function setProjectId(?int $projectId): self
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function getLinkId(): ?int
    {
        return $this->linkId;
    }

    public function setLinkId(?int $linkId): self
    {
        $this->linkId = $linkId;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(?\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getMobileAvg(): ?string
    {
        return $this->mobileAvg;
    }

    public function setMobileAvg(?string $mobileAvg): self
    {
        $this->mobileAvg = $mobileAvg;

        return $this;
    }

    public function getDesktopAvg(): ?string
    {
        return $this->desktopAvg;
    }

    public function setDesktopAvg(?string $desktopAvg): self
    {
        $this->desktopAvg = $desktopAvg;

        return $this;
    }

    public function getJSON(): ?string
    {
        return $this->JSON;
    }

    public function setJSON(?string $JSON): self
    {
        $this->JSON = $JSON;

        return $this;
    }
}
