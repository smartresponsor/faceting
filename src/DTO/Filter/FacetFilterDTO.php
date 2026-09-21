<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Filter;

use App\Faceting\Enum\FacetFilterOperator;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;

/**
 * Declares selected facet values without performing search or catalog query execution.
 */
final readonly class FacetFilterDTO
{
    /**
     * @var non-empty-list<FacetValueIdentifier>
     */
    public array $valueIdentifiers;

    /**
     * @param list<FacetValueIdentifier> $valueIdentifiers
     */
    public function __construct(
        public FacetCode $facetIdentifier,
        array $valueIdentifiers,
        public FacetFilterOperator $operator = FacetFilterOperator::Any,
    ) {
        if ([] === $valueIdentifiers) {
            throw new \InvalidArgumentException('Facet filter must select at least one value.');
        }

        $seen = [];
        foreach ($valueIdentifiers as $valueIdentifier) {
            $key = $valueIdentifier->toString();
            if (isset($seen[$key])) {
                throw new \InvalidArgumentException(sprintf('Facet filter contains duplicate value identifier "%s".', $key));
            }
            $seen[$key] = true;
        }

        $this->valueIdentifiers = $valueIdentifiers;
    }
}
