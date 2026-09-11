<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

final readonly class FacetCollectionDTO
{
    /** @param list<FacetItemDTO> $items */
    public function __construct(
        public array $items,
    ) {
    }
}
