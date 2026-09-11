<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Demo;

final readonly class FacetDemoDatasetDTO
{
    /** @param list<FacetDemoRowDTO> $items */
    public function __construct(
        public array $items,
    ) {
    }
}
