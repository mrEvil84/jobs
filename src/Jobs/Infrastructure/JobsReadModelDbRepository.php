<?php

declare(strict_types=1);

namespace JobsApp\Jobs\Infrastructure;

use JobsApp\Jobs\SharedKernel\{JobsPositionDtoCollection, JobsPositionDtoCollectionFactory};
use Illuminate\Database\ConnectionInterface;
use JobsApp\Jobs\ReadModel\JobsReadModelRepository;

class JobsReadModelDbRepository implements JobsReadModelRepository
{
    /**
     * @var ConnectionInterface
     */
    private $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function findAllJobPositions(): JobsPositionDtoCollection
    {
        $result = $this->db->select('
            SELECT 
                   p.id AS id,
                   p.reference AS reference,
                   p.title AS title,
                   p.job_description AS job_description,
                   p.email AS email,
                   p.company_id AS company_id,
                   c.name AS company_name
            FROM
                positions AS p
            JOIN 
                companies  AS c 
            ON
                p.company_id = c.id
    
        ');

        return JobsPositionDtoCollectionFactory::fromRawData($result);
    }
}
