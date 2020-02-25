<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs\Infrastructure;

use Illuminate\Database\ConnectionInterface;
use JobsApp\Jobs\Commands\AddJobPosition;
use JobsApp\Jobs\Infrastructure\JobsDbRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Jobs\JobsMother;

class JobsDbRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddJobPositionWhenCompanyNotExist(): void
    {
        $connectionInterfaceMock = $this->createMock(ConnectionInterface::class);
        $connectionInterfaceMock
            ->expects(self::exactly(2))
            ->method('select')
            ->will(
                $this->onConsecutiveCalls(null, JobsMother::getCompanyRawData())
            );

        $connectionInterfaceMock->expects(self::exactly(2))->method('insert');

        $sut = new JobsDbRepository($connectionInterfaceMock);
        $sut->addJobPosition(
            new AddJobPosition(
                'test_title',
                'test_job_description',
                'test@job1.com',
                'test1'
            )
        );
    }

    /**
     * @test
     */
    public function shouldNotAddJobPositionWhenError(): void
    {
        $connectionInterfaceMock = $this->createMock(ConnectionInterface::class);
        $connectionInterfaceMock
            ->expects(self::once())
            ->method('beginTransaction');

        $connectionInterfaceMock
            ->expects(self::once())
            ->method('rollBack');

        $connectionInterfaceMock
            ->expects(self::once())
            ->method('select')
            ->willThrowException(new \PDOException('error'));

        $sut = new JobsDbRepository($connectionInterfaceMock);

        $this->expectException(\PDOException::class);
        $sut->addJobPosition(
            new AddJobPosition(
                'test_title',
                'test_job_description',
                'test@job1.com',
                'test1'
            )
        );
    }

}
