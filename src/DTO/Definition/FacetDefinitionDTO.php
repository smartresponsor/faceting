<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Definition;

use App\Faceting\Enum\FacetType;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;

/**
 * Neutral facet-definition contract shared with indexing, searching, and storefront consumers.
 *
 * The facet code is the stable semantic identifier. Searchability and filterability declare
 * eligibility only; this contract does not execute search or indexing work.
 */
final readonly class FacetDefinitionDTO
{
    public function __construct(
        public FacetCode $identifier,
        public FacetName $label,
        public FacetType $type,
        public bool $filterable,
        public bool $searchable,
        public int $position = 0,
    ) {
        if ($position < 0) {
            throw new \InvalidArgumentException('Facet position must not be negative.');
        }
    }
}
