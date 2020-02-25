<?php

declare(strict_types=1);

namespace JobsApp\Jobs\Infrastructure;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Str;
use JobsApp\Jobs\Commands\AddJobPosition;
use JobsApp\Jobs\Domain\JobsRepository;
use JobsApp\Jobs\SharedKernel\CompanyDto;
use PDOException;

class JobsDbRepository implements JobsRepository
{
    /**
     * @var ConnectionInterface
     */
    private $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function addJobPosition(AddJobPosition $command): void
    {
        try {
            $this->db->beginTransaction();

            $companyDto = $this->getCompanyByName($command->getCompanyName());
            if (null === $companyDto) {
                $this->db->insert(
                '
                    INSERT INTO companies (name) VALUE(:companyName)
                ',
                    [
                        'companyName' => $command->getCompanyName()
                    ]
                );
                $companyDto = $this->getCompanyByName($command->getCompanyName());
            }

            $this->db->insert(
                '
                INSERT INTO positions (reference, title, job_description, email, company_id)
                VALUES (
                    :reference,
                    :title,
                    :job_description,
                    :email,
                    :company_id
                )
            ',
                [
                    'reference' => Str::uuid()->toString(),
                    'title' => $command->getTitle(),
                    'job_description' => $command->getJobDescription(),
                    'email' => $command->getEmail(),
                    'company_id' => $companyDto->getId()
                ]
            );
            $this->db->commit();

        } catch (PDOException $exception) {
            $this->db->rollBack();
            throw $exception;
        }
    }

    private function getCompanyByName(string $name): ?CompanyDto
    {
        $result = $this->db->select('
            SELECT
                c.id,
                c.name
            FROM
                companies AS c
            WHERE
                c.name = :companyName
        ',
            [
                'companyName' => $name
            ]
        );

        return empty($result) ? null : new CompanyDto($result[0]->id, $result[0]->name);
    }
}
