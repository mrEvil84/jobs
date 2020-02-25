<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs;

class JobsMother
{

    public static function getJobsPositionRawData(): array
    {
        return [
            (object)[
                'id' => 1,
                'reference' => 'b4dddfad-b7d9-4992-9289-d2c250f8bf54',
                'title' => 'job offer test',
                'job_description' => 'some job description',
                'email' => 'test@test.com',
                'company_id' => 1,
                'company_name' => 'company 1'
            ],
            (object)[
                'id' => 1,
                'reference' => '07fc09e3-6c79-4774-8af1-88671c70e52f',
                'title' => 'job offer test 2',
                'job_description' => 'some job description 2',
                'email' => 'test2@test.com',
                'company_id' => 2,
                'company_name' => 'company 2'
            ],
        ];
    }

    public static function getCompanyRawData(): array
    {
        return [
            (object)[
                'id' => 1,
                'name' => 'test_company'
            ]
        ];
    }

}
