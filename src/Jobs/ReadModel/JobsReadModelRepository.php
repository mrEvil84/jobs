<?php

declare(strict_types=1);

namespace JobsApp\Jobs\ReadModel;

use JobsApp\Jobs\SharedKernel\JobsPositionDtoCollection;

interface JobsReadModelRepository
{
    public function findAllJobPositions(): JobsPositionDtoCollection;
}
