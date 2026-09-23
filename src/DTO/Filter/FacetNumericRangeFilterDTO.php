<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Filter;

use App\Faceting\ValueObject\Definition\Facet\FacetCode;

/**
 * Declares a bounded numeric facet predicate without performing query execution.
 */
final readonly class FacetNumericRangeFilterDTO
{
    public function __construct(
        public FacetCode $facetIdentifier,
        public int|float|null $minimum = null,
        public int|float|null $maximum = null,
        public bool $minimumInclusive = true,
        public bool $maximumInclusive = true,
    ) {
        if (null === $minimum && null === $maximum) {
            throw new \InvalidArgumentException('Numeric facet range must define at least one boundary.');
        }

        if (null !== $minimum && null !== $maximum && $minimum > $maximum) {
            throw new \InvalidArgumentException('Numeric facet range minimum must not exceed maximum.');
        }
    }
}
