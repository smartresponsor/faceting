<?php

declare(strict_types=1);

namespace App\Service\Facet;

use App\Dto\Facet\FacetUpsertRequest;
use App\Enum\FacetType;
use App\Repository\FacetRepository;
use App\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;

final class FacetingFacetService implements FacetingFacetServiceInterface
{
    public function __construct(
        private readonly FacetRepository $facetRepository,
        private readonly FacetingDemoDatasetServiceInterface $facetingDemoDatasetService,
    ) {
    }

    public function listDemoFacets(): array
    {
        $items = [];
        foreach ($this->facetRepository->findOrderedVisibleFacets() as $facet) {
            $items[] = [
                'code' => $facet->getCode()->toString(),
                'name' => $facet->getName()->toString(),
                'type' => $facet->getType()->value,
                'visible' => $facet->isVisible(),
            ];
        }

        if ([] !== $items) {
            return $items;
        }

        foreach ($this->facetingDemoDatasetService->buildDataset() as $row) {
            if (true !== $row['visible']) {
                continue;
            }

            $items[] = [
                'code' => $row['code'],
                'name' => $row['name'],
                'type' => $row['type']->value,
                'visible' => $row['visible'],
            ];
        }

        return $items;
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
