<?php

declare(strict_types=1);

namespace JobsApp\Jobs\Application;

use JobsApp\Jobs\Commands\AddJobPosition;
use JobsApp\Jobs\Domain\JobsRepository;

class JobsService
{
    /**
     * @var JobsRepository
     */
    private $repository;

    public function __construct(JobsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addJobPosition(AddJobPosition $command): void
    {
        $this->repository->addJobPosition($command);
    }
}
