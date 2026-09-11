<?php

declare(strict_types=1);

namespace App\Faceting\Builder\Management\Facet;

use App\Faceting\BuilderInterface\Listing\Criteria\FacetListingCriteriaBuilderInterface;
use App\Faceting\DTO\Management\Facet\FacetManagementSurfaceDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Form\Management\Facet\FacetUpsertType;
use App\Faceting\ServiceInterface\Listing\FacetEngineServiceInterface;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Assembles the typed management presentation payload for the Faceting management screen.
 */
final readonly class FacetManagementSurfaceBuilder
{
    /**
     * Initializes the management builder with its facet, listing, criteria, and form collaborators.
     */
    public function __construct(
        private FacetServiceInterface $facetingFacetService,
        private FacetEngineServiceInterface $facetingEngineService,
        private FacetListingCriteriaBuilderInterface $facetingListingCriteriaBuilder,
        private FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * Builds the complete typed management surface after processing the incoming form request.
     */
    public function build(Request $request): FacetManagementSurfaceDTO
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

        return new FacetManagementSurfaceDTO(
            [
                'surface' => 'facet',
                'operation' => 'index',
                'component' => 'Faceting',
                'intent' => 'management',
            ],
            [
                'body' => ['facet.management'],
            ],
            [
                'facets' => $listingResult->items,
                'facetTotal' => $listingResult->total,
                'facetAggregations' => $listingResult->aggregations,
                'listingCriteria' => $criteria,
                'facetForm' => $form->createView(),
                'materializedFacet' => $materializedFacet,
            ],
            [
                'title' => 'Facet management',
            ],
        );
    }
}
