<?php

declare(strict_types=1);

namespace JobsApp\Jobs\ReadModel;

use JobsApp\Jobs\SharedKernel\JobsPositionDtoCollection;

class JobsReadModel
{
    /**
     * @var JobsReadModelRepository
     */
    private $repository;

    public function __construct(JobsReadModelRepository $repository)
    {
        $this->repository = $repository;
    }
    public function findAllJobPositions(): JobsPositionDtoCollection
    {
        return $this->repository->findAllJobPositions();
    }

}
