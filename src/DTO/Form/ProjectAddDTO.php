<?php


namespace App\DTO\Form;

class ProjectAddDTO
{
    private string $domain;
    private string $client;
    private string $type;
    private bool $status;

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return ProjectAddDTO
     */
    public function setDomain(string $domain): ProjectAddDTO
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     * @return ProjectAddDTO
     */
    public function setClient(string $client): ProjectAddDTO
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ProjectAddDTO
     */
    public function setType(string $type): ProjectAddDTO
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return ProjectAddDTO
     */
    public function setStatus(bool $status): ProjectAddDTO
    {
        $this->status = $status;
        return $this;
    }
}