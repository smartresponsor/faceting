<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

/**
 * Carries one aggregation bucket key and its result count across listing boundaries.
 */
final class FacetAggregationBucketDTO
{
    public string $key = '';

    public int $count = 0;
}
