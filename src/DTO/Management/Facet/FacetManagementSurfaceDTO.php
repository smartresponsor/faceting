<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

final readonly class FacetManagementSurfaceDTO
{
    /**
     * @param array<string, mixed> $view
     * @param array<string, mixed> $locations
     * @param array<string, mixed> $data
     * @param array<string, mixed> $meta
     */
    public function __construct(
        public array $view,
        public array $locations,
        public array $data,
        public array $meta,
    ) {
    }
}
