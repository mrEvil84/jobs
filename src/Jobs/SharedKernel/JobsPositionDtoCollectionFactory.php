<?php

declare(strict_types=1);

namespace JobsApp\Jobs\SharedKernel;

class JobsPositionDtoCollectionFactory
{
    public static function fromRawData(array $rawData): JobsPositionDtoCollection
    {
        $collection = new JobsPositionDtoCollection();
        /** @var \stdClass $item */
        foreach ($rawData as $item) {
            $collection->add(
                new JobPositionDto(
                    (int)$item->id,
                    $item->reference,
                    $item->title,
                    $item->job_description,
                    $item->email,
                    new CompanyDto(
                        (int)$item->company_id,
                        $item->company_name)
                )
            );
        }
        return $collection;
    }
}
