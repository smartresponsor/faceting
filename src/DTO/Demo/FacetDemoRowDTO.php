<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Demo;

use App\Faceting\Enum\FacetType;

final readonly class FacetDemoRowDTO
{
    public function __construct(
        public string $code,
        public string $nameEntity,
        public FacetType $type,
        public bool $visible,
        public int $position,
    ) {
    }
}
