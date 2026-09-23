<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Aggregation;

use App\Faceting\ValueObject\Definition\Facet\FacetCode;

/**
 * Declares neutral aggregation/count requirements for a facet without selecting an execution backend.
 */
final readonly class FacetAggregationRequestDTO
{
    public function __construct(
        public FacetCode $facetIdentifier,
        public int $limit = 50,
        public bool $includeZeroCounts = false,
    ) {
        if ($limit < 1 || $limit > 1000) {
            throw new \InvalidArgumentException('Facet aggregation limit must be between 1 and 1000.');
        }
    }
}
