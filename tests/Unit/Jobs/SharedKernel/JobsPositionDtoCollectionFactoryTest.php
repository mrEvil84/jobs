<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs\SharedKernel;

use JobsApp\Jobs\SharedKernel\JobsPositionDtoCollectionFactory;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Jobs\JobsMother;

class JobsPositionDtoCollectionFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldFromRawData(): void
    {
        $jobsPositionsDtoCollection = JobsPositionDtoCollectionFactory::fromRawData(JobsMother::getJobsPositionRawData());

        self::assertEquals(2, $jobsPositionsDtoCollection->count());
        self::assertEquals(1, $jobsPositionsDtoCollection->first()->getId());
        self::assertEquals('company 1', $jobsPositionsDtoCollection->first()->getCompanyDto()->getName());
    }

}
