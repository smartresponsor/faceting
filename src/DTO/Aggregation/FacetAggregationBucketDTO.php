<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Aggregation;

use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;

/**
 * Carries one stable facet-value identifier and its backend-computed resource count.
 */
final readonly class FacetAggregationBucketDTO
{
    public function __construct(
        public FacetValueIdentifier $valueIdentifier,
        public int $count,
        public int $position = 0,
    ) {
        if ($count < 0) {
            throw new \InvalidArgumentException('Facet aggregation count must not be negative.');
        }

        if ($position < 0) {
            throw new \InvalidArgumentException('Facet aggregation position must not be negative.');
        }
    }
}
