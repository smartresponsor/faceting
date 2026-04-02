<?php

declare(strict_types=1);

namespace App\Dto\Listing;

final class FacetingAggregationResult
{
    /** @var list<FacetingAggregationBucket> */
    public array $types = [];

    /** @var list<FacetingAggregationBucket> */
    public array $visibility = [];
}
