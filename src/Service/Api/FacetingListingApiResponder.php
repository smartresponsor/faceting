<?php

declare(strict_types=1);

namespace App\Faceting\Service\Api;

use App\Faceting\ServiceInterface\Listing\FacetingEngineServiceInterface;
use App\Faceting\ServiceInterface\Listing\FacetingListingCriteriaBuilderServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final readonly class FacetingListingApiResponder
{
    public function __construct(
        private FacetingEngineServiceInterface $facetingEngineService,
        private FacetingListingCriteriaBuilderServiceInterface $facetingListingCriteriaBuilderService,
    ) {
    }

    public function list(Request $request): JsonResponse
    {
        $criteria = $this->facetingListingCriteriaBuilderService->buildFromRequest($request);
        $result = $this->facetingEngineService->resolve($criteria);

        return new JsonResponse([
            'total' => $result->total,
            'items' => $result->items,
            'aggregations' => [
                'types' => array_map(
                    static fn ($bucket) => [
                        'key' => $bucket->key,
                        'count' => $bucket->count,
                    ],
                    $result->aggregations->types,
                ),
                'visibility' => array_map(
                    static fn ($bucket) => [
                        'key' => $bucket->key,
                        'count' => $bucket->count,
                    ],
                    $result->aggregations->visibility,
                ),
            ],
        ]);
    }
}
