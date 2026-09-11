<?php

declare(strict_types=1);

namespace App\Faceting\Builder\Management\Facet;

use App\Faceting\BuilderInterface\Listing\Criteria\FacetListingCriteriaBuilderInterface;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Form\Management\Facet\FacetUpsertType;
use App\Faceting\ServiceInterface\Listing\FacetEngineServiceInterface;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class FacetManagementSurfaceBuilder
{
    public function __construct(
        private FacetServiceInterface $facetingFacetService,
        private FacetEngineServiceInterface $facetingEngineService,
        private FacetListingCriteriaBuilderInterface $facetingListingCriteriaBuilder,
        private FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function build(Request $request): array
    {
        $materializedFacet = null;
        $facetUpsertDTO = new FacetUpsertDTO();
        $form = $this->formFactory->create(FacetUpsertType::class, $facetUpsertDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materializedFacet = $this->facetingFacetService->materialize($facetUpsertDTO);
        }

        $criteria = $this->facetingListingCriteriaBuilder->buildFromRequest($request);
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
