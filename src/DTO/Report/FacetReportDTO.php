<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Report;

final readonly class FacetReportDTO
{
    /** @param array<string, int> $byType */
    public function __construct(
        public int $total,
        public int $visible,
        public int $hidden,
        public array $byType,
    ) {
    }
}
