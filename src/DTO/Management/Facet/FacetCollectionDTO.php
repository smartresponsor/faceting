<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

/**
 * Carries the typed facet item collection returned by management and listing services.
 */
final readonly class FacetCollectionDTO
{
    /** @param list<FacetItemDTO> $items */
    public function __construct(
        public array $items,
    ) {
    }
}
