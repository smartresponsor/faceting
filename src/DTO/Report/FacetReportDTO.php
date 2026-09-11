<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Report;

/**
 * Carries aggregate Faceting report totals and deterministic counts grouped by facet type.
 */
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
