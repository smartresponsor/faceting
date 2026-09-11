<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

final class FacetAggregationBucketDTO
{
    public string $key = '';

    public int $count = 0;
}
