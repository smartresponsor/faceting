<?php

declare(strict_types=1);

namespace App\Service\Listing;

use App\Dto\Listing\FacetingListingCriteria;
use App\Dto\Listing\FacetingListingResult;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ServiceInterface\Listing\FacetingEngineServiceInterface;

final class FacetingEngineService implements FacetingEngineServiceInterface
{
    public function __construct(
        private readonly FacetingFacetServiceInterface $facetService,
    ) {
    }

    public function resolve(FacetingListingCriteria $criteria): FacetingListingResult
    {
        $items = $this->facetService->listDemoFacets();

        $filtered = [];

        foreach ($items as $item) {
            if (null !== $criteria->type && $item['type'] !== $criteria->type) {
                continue;
            }

            if (null !== $criteria->visible && $item['visible'] !== $criteria->visible) {
                continue;
            }

            if (null !== $criteria->search && '' !== $criteria->search) {
                $needle = strtolower($criteria->search);
                if (!str_contains(strtolower($item['code']), $needle)
                    && !str_contains(strtolower($item['name']), $needle)) {
                    continue;
                }
            }

            $filtered[] = $item;
        }

        $result = new FacetingListingResult();
        $result->items = array_values($filtered);
        $result->total = count($filtered);

        return $result;
    }
}
