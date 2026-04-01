<?php

declare(strict_types=1);

namespace App\Service\Report;

use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ServiceInterface\Report\FacetingReportServiceInterface;

final class FacetingReportService implements FacetingReportServiceInterface
{
    public function __construct(
        private readonly FacetingFacetServiceInterface $facetingFacetService,
    ) {
    }

    public function buildDemoFacetReport(): array
    {
        $facets = $this->facetingFacetService->listDemoFacets();
        $byType = [];
        $visible = 0;

        foreach ($facets as $facet) {
            $type = (string) $facet['type'];
            $byType[$type] = ($byType[$type] ?? 0) + 1;

            if (true === (bool) $facet['visible']) {
                ++$visible;
            }
        }

        ksort($byType);

        return [
            'total' => count($facets),
            'visible' => $visible,
            'hidden' => count($facets) - $visible,
            'byType' => $byType,
        ];
    }
}
