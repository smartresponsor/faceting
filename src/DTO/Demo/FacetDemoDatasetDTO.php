<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Demo;

/**
 * Carries the complete deterministic demo facet dataset across component service boundaries.
 */
final readonly class FacetDemoDatasetDTO
{
    /** @param list<FacetDemoRowDTO> $items */
    public function __construct(
        public array $items,
    ) {
    }
}
