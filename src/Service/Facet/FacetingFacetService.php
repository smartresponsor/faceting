<?php

declare(strict_types=1);

namespace App\Service\Facet;

use App\Dto\Facet\FacetUpsertRequest;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ValueObject\Facet\FacetCode;

final class FacetingFacetService implements FacetingFacetServiceInterface
{
    public function listDemoFacets(): array
    {
        return [
            ['code' => 'brand', 'name' => 'Brand', 'type' => 'term', 'visible' => true],
            ['code' => 'price', 'name' => 'Price', 'type' => 'range', 'visible' => true],
            ['code' => 'available', 'name' => 'Available', 'type' => 'boolean', 'visible' => true],
        ];
    }

    public function materialize(FacetUpsertRequest $request): array
    {
        $code = new FacetCode($request->code);

        return [
            'code' => $code->toString(),
            'name' => trim($request->name),
            'type' => $request->type,
            'visible' => $request->visible,
        ];
    }
}
