<?php

declare(strict_types=1);

namespace JobsApp\Jobs\Domain;

use JobsApp\Jobs\Commands\AddJobPosition;

interface JobsRepository
{
    public function addJobPosition(AddJobPosition $command): void;
}
