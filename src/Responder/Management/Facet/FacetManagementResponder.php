<?php

declare(strict_types=1);

namespace App\Faceting\Responder\Management\Facet;

use App\Faceting\Builder\Management\Facet\FacetManagementSurfaceBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
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
