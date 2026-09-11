<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

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
