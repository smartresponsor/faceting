<?php

declare(strict_types=1);

namespace App\Faceting\Responder\Management\Facet;

use App\Faceting\Builder\Management\Facet\FacetManagementSurfaceBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Twig\Environment;

/**
 * Renders the Faceting management surface from its typed builder payload and request context.
 */
final readonly class FacetManagementResponder
{
    /**
     * Initializes management rendering with the typed surface builder and Twig environment.
     */
    public function __construct(
        private FacetManagementSurfaceBuilder $surfaceBuilder,
        private Environment $twig,
    ) {
    }

    /**
     * Renders the management page and emits a success flash after valid facet preview materialization.
     */
    public function respond(Request $request): Response
    {
        $payload = $this->surfaceBuilder->build($request);
        $data = $payload->data;
        if (($data['materializedFacet'] ?? null) !== null && $request->hasSession()) {
            $flashBag = $request->getSession()->getBag('flashes');
            if ($flashBag instanceof FlashBagInterface) {
                $flashBag->add('success', 'Facet preview generated.');
            }
        }

        return new Response($this->twig->render('facet_management/index.html.twig', $data + [
            '_view' => $payload->view,
            'locations' => $payload->locations,
            'meta' => $payload->meta,
        ]));
    }
}
