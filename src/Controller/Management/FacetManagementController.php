<?php

declare(strict_types=1);

namespace App\Controller\Management;

use App\Dto\Facet\FacetUpsertRequest;
use App\Form\Facet\FacetUpsertType;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class FacetManagementController extends AbstractController
{
    public function __construct(
        private readonly FacetingFacetServiceInterface $facetingFacetService,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $facetUpsertRequest = new FacetUpsertRequest();
        $facetUpsertRequest->code = 'brand';
        $facetUpsertRequest->name = 'Brand';
        $facetUpsertRequest->type = 'term';
        $facetUpsertRequest->visible = true;

        $form = $this->createForm(FacetUpsertType::class, $facetUpsertRequest, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        $materializedFacet = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $materializedFacet = $this->facetingFacetService->materialize($facetUpsertRequest);
            $this->addFlash('success', 'Facet preview generated.');
        }

        return $this->render('facet_management/index.html.twig', [
            'facets' => $this->facetingFacetService->listDemoFacets(),
            'facetForm' => $form->createView(),
            'materializedFacet' => $materializedFacet,
        ]);
    }
}
