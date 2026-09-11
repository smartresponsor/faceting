<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

final class FacetAggregationResultDTO
{
    /** @var list<FacetAggregationBucketDTO> */
    public array $types = [];

    /** @var list<FacetAggregationBucketDTO> */
    public array $visibility = [];
}
