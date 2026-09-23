<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Filter;

use App\Faceting\ValueObject\Definition\Facet\FacetCode;

/**
 * Declares a bounded date/time facet predicate without performing query execution.
 */
final readonly class FacetDateRangeFilterDTO
{
    public function __construct(
        public FacetCode $facetIdentifier,
        public ?\DateTimeImmutable $minimum = null,
        public ?\DateTimeImmutable $maximum = null,
        public bool $minimumInclusive = true,
        public bool $maximumInclusive = true,
    ) {
        if (null === $minimum && null === $maximum) {
            throw new \InvalidArgumentException('Date facet range must define at least one boundary.');
        }

        if (null !== $minimum && null !== $maximum && $minimum > $maximum) {
            throw new \InvalidArgumentException('Date facet range minimum must not exceed maximum.');
        }
    }
}
