<?php

declare(strict_types=1);

namespace App\Faceting\Responder\Api\Listing;

use App\Faceting\BuilderInterface\Listing\Criteria\FacetListingCriteriaBuilderInterface;
use App\Faceting\ServiceInterface\Listing\FacetEngineServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Converts typed Faceting listing results into the stable JSON response contract for API callers.
 */
final readonly class FacetListingApiResponder
{
    /**
     * Initializes the API responder with typed criteria and listing engine collaborators.
     */
    public function __construct(
        private FacetEngineServiceInterface $facetingEngineService,
        private FacetListingCriteriaBuilderInterface $facetingListingCriteriaBuilder,
    ) {
    }

    /**
     * Builds a stable JSON listing response from request criteria and typed aggregation results.
     */
    public function list(Request $request): JsonResponse
    {
        $criteria = $this->facetingListingCriteriaBuilder->buildFromRequest($request);
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
