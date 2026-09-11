<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

/**
 * Groups typed aggregation buckets for facet type and visibility dimensions in listing results.
 */
final class FacetAggregationResultDTO
{
    /** @var list<FacetAggregationBucketDTO> */
    public array $types = [];

    /** @var list<FacetAggregationBucketDTO> */
    public array $visibility = [];
}
