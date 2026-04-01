<?php

declare(strict_types=1);

namespace App\Service\Facet;

use App\Dto\Facet\FacetUpsertRequest;
use App\Enum\FacetType;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;

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
        $name = new FacetName($request->name);
        $type = FacetType::from($request->type);

        return [
            'code' => $code->toString(),
            'name' => $name->toString(),
            'type' => $type->value,
            'visible' => $request->visible,
        ];
    }
}
