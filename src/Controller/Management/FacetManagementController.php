<?php

declare(strict_types=1);

namespace App\Controller\Management;

use App\Dto\Facet\FacetUpsertRequest;
use App\Form\Facet\FacetUpsertType;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ServiceInterface\Listing\FacetingEngineServiceInterface;
use App\ServiceInterface\Listing\FacetingListingCriteriaBuilderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FacetManagementController extends AbstractController
{
    public function __construct(
        private readonly FacetingFacetServiceInterface $facetingFacetService,
        private readonly FacetingEngineServiceInterface $facetingEngineService,
        private readonly FacetingListingCriteriaBuilderServiceInterface $facetingListingCriteriaBuilderService,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $materializedFacet = null;
        $facetUpsertRequest = new FacetUpsertRequest();
        $form = $this->createForm(FacetUpsertType::class, $facetUpsertRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materializedFacet = $this->facetingFacetService->materialize($facetUpsertRequest);
            $this->addFlash('success', 'Facet preview generated.');
        }

        $criteria = $this->facetingListingCriteriaBuilderService->buildFromRequest($request);
        $listingResult = $this->facetingEngineService->resolve($criteria);

        return $this->render('facet_management/index.html.twig', [
            'facets' => $listingResult->items,
            'facetTotal' => $listingResult->total,
            'facetAggregations' => $listingResult->aggregations,
            'listingCriteria' => $criteria,
            'facetForm' => $form->createView(),
            'materializedFacet' => $materializedFacet,
        ]);
    }
}
