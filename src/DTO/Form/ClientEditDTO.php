<?php
namespace App\DTO\Form;

class ClientEditDTO
{
    private ?string $companyName;
    private ?string $companyNipNumber;

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param ?string $companyName
     * @return ClientEditDTO
     */
    public function setCompanyName(?string $companyName): ClientEditDTO
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyNipNumber(): string
    {
        return $this->companyNipNumber;
    }

    /**
     * @param ?string $companyNipNumber
     * @return ClientEditDTO
     */
    public function setCompanyNipNumber(?string $companyNipNumber): ClientEditDTO
    {
        $this->companyNipNumber = $companyNipNumber;
        return $this;
    }
}