<?php

declare(strict_types=1);

namespace App\Faceting\Service\Management;

use App\Faceting\Dto\Facet\FacetUpsertRequest;
use App\Faceting\Form\Facet\FacetUpsertType;
use App\Faceting\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\Faceting\ServiceInterface\Listing\FacetingEngineServiceInterface;
use App\Faceting\ServiceInterface\Listing\FacetingListingCriteriaBuilderServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class FacetManagementSurfaceBuilder
{
    public function __construct(
        private FacetingFacetServiceInterface $facetingFacetService,
        private FacetingEngineServiceInterface $facetingEngineService,
        private FacetingListingCriteriaBuilderServiceInterface $facetingListingCriteriaBuilderService,
        private FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function build(Request $request): array
    {
        $materializedFacet = null;
        $facetUpsertRequest = new FacetUpsertRequest();
        $form = $this->formFactory->create(FacetUpsertType::class, $facetUpsertRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materializedFacet = $this->facetingFacetService->materialize($facetUpsertRequest);
        }

        $criteria = $this->facetingListingCriteriaBuilderService->buildFromRequest($request);
        $listingResult = $this->facetingEngineService->resolve($criteria);

        return [
            '_view' => [
                'surface' => 'facet',
                'operation' => 'index',
                'component' => 'Faceting',
                'intent' => 'management',
            ],
            'locations' => [
                'body' => ['facet.management'],
            ],
            'data' => [
                'facets' => $listingResult->items,
                'facetTotal' => $listingResult->total,
                'facetAggregations' => $listingResult->aggregations,
                'listingCriteria' => $criteria,
                'facetForm' => $form->createView(),
                'materializedFacet' => $materializedFacet,
            ],
            'meta' => [
                'title' => 'Facet management',
            ],
        ];
    }
}
