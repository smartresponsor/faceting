<?php

declare(strict_types=1);

namespace App\Faceting\Service\Report;

use App\Faceting\DTO\Report\FacetReportDTO;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use App\Faceting\ServiceInterface\Report\FacetReportServiceInterface;

final class FacetReportService implements FacetReportServiceInterface
{
    public function __construct(
        private readonly FacetServiceInterface $facetingFacetService,
    ) {
    }

    public function buildDemoFacetReport(): FacetReportDTO
    {
        $facets = $this->facetingFacetService->listDemoFacets()->items;
        $byType = [];
        $visible = 0;

        foreach ($facets as $facet) {
            $byType[$facet->type] = ($byType[$facet->type] ?? 0) + 1;

            if (true === $facet->visible) {
                ++$visible;
            }
        }

        ksort($byType);

        return new FacetReportDTO(
            count($facets),
            $visible,
            count($facets) - $visible,
            $byType,
        );
    }
}
