<?php

declare(strict_types=1);

namespace App\Faceting\Service\Report;

use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use App\Faceting\ServiceInterface\Report\FacetReportServiceInterface;

final class FacetReportService implements FacetReportServiceInterface
{
    public function __construct(
        private readonly FacetServiceInterface $facetingFacetService,
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
