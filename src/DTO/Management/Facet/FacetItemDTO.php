<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

/**
 * Carries one normalized facet item across management, listing, and reporting boundaries.
 */
final readonly class FacetItemDTO
{
    public function __construct(
        public string $code,
        public string $nameEntity,
        public string $type,
        public bool $visible,
    ) {
    }
}
