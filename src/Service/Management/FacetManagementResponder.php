<?php

declare(strict_types=1);

namespace App\Faceting\Service\Management;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final readonly class FacetManagementResponder
{
    public function __construct(
        private FacetManagementSurfaceBuilder $surfaceBuilder,
        private Environment $twig,
    ) {
    }

    public function respond(Request $request): Response
    {
        $payload = $this->surfaceBuilder->build($request);
        $data = $payload['data'] ?? [];
        if (($data['materializedFacet'] ?? null) !== null && $request->hasSession()) {
            $request->getSession()->getFlashBag()->add('success', 'Facet preview generated.');
        }

        return new Response($this->twig->render('facet_management/index.html.twig', $data + [
            '_view' => $payload['_view'] ?? [],
            'locations' => $payload['locations'] ?? [],
            'meta' => $payload['meta'] ?? [],
        ]));
    }
}
