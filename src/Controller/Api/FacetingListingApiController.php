<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\ServiceInterface\Listing\FacetingEngineServiceInterface;
use App\ServiceInterface\Listing\FacetingListingCriteriaBuilderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class FacetingListingApiController extends AbstractController
{
    public function __construct(
        private readonly FacetingEngineServiceInterface $facetingEngineService,
        private readonly FacetingListingCriteriaBuilderServiceInterface $facetingListingCriteriaBuilderService,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $criteria = $this->facetingListingCriteriaBuilderService->buildFromRequest($request);
        $result = $this->facetingEngineService->resolve($criteria);

        return $this->json([
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
