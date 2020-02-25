<?php

declare(strict_types=1);

namespace JobsApp\Jobs\Commands;

/**
 * @codeCoverageIgnore
 */
class AddJobPosition
{
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
     * @var string
     */
    private $companyName;

    public function __construct(string $title, string $jobDescription, string $email, string $companyName)
    {
        $this->title = $title;
        $this->jobDescription = $jobDescription;
        $this->email = $email;
        $this->companyName = $companyName;
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

    public function getCompanyName(): string
    {
        return $this->companyName;
    }
}
