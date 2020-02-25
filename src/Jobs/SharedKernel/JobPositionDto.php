<?php

declare(strict_types=1);

namespace JobsApp\Jobs\SharedKernel;

class JobPositionDto
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $reference;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $jobDescription;
    /**
     * @var string
     */
    private $email;
    /**
     * @var CompanyDto
     */
    private $companyDto;

    public function __construct(int $id, string $reference, string $title, string $jobDescription, string $email, CompanyDto $companyDto)
    {
        $this->id = $id;
        $this->reference = $reference;
        $this->title = $title;
        $this->jobDescription = $jobDescription;
        $this->email = $email;
        $this->companyDto = $companyDto;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getJobDescription(): string
    {
        return $this->jobDescription;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCompanyDto(): CompanyDto
    {
        return $this->companyDto;
    }
}
