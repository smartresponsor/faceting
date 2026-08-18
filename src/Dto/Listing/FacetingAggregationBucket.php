<?php

declare(strict_types=1);

namespace App\Faceting\Dto\Listing;

final class FacetingAggregationBucket
{
    public string $key = '';

    public int $count = 0;
}
