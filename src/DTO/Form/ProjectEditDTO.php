<?php


namespace App\DTO\Form;


class ProjectEditDTO
{

    private string $domain;
    private string $client;
    private string $type;
    private bool $status;
    private bool $minuteTest;
    private bool $speedTest;
    private bool $updateTest;

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return ProjectEditDTO
     */
    public function setDomain(string $domain): ProjectEditDTO
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
     * @return ProjectEditDTO
     */
    public function setClient(string $client): ProjectEditDTO
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
     * @return ProjectEditDTO
     */
    public function setType(string $type): ProjectEditDTO
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
     * @return ProjectEditDTO
     */
    public function setStatus(bool $status): ProjectEditDTO
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMinuteTest(): bool
    {
        return $this->minuteTest;
    }

    /**
     * @param bool $minuteTest
     * @return ProjectEditDTO
     */
    public function setMinuteTest(bool $minuteTest): ProjectEditDTO
    {
        $this->minuteTest = $minuteTest;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSpeedTest(): bool
    {
        return $this->speedTest;
    }

    /**
     * @param bool $speedTest
     * @return ProjectEditDTO
     */
    public function setSpeedTest(bool $speedTest): ProjectEditDTO
    {
        $this->speedTest = $speedTest;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUpdateTest(): bool
    {
        return $this->updateTest;
    }

    /**
     * @param bool $updateTest
     * @return ProjectEditDTO
     */
    public function setUpdateTest(bool $updateTest): ProjectEditDTO
    {
        $this->updateTest = $updateTest;
        return $this;
    }

}

