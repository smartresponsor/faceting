<?php

declare(strict_types=1);

namespace App\Faceting\Service\Management\Facet;

use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Enum\FacetType;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;

final class FacetService implements FacetServiceInterface
{
    public function __construct(
        private readonly FacetRepository $facetRepository,
        private readonly FacetDemoDatasetServiceInterface $facetingDemoDatasetService,
    ) {
    }

    public function listDemoFacets(): array
    {
        $items = [];
        foreach ($this->facetRepository->findOrderedVisibleFacets() as $facet) {
            $items[] = [
                'code' => $facet->getCode()->toString(),
                'nameEntity' => $facet->getName()->toString(),
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
                'nameEntity' => $row['nameEntity'],
                'type' => $row['type']->value,
                'visible' => $row['visible'],
            ];
        }

        return $items;
    }

    public function materialize(FacetUpsertDTO $request): array
    {
        $code = new FacetCode($request->code);
        $nameEntity = new FacetName($request->nameEntity);
        $type = FacetType::from($request->type);

        return [
            'code' => $code->toString(),
            'nameEntity' => $nameEntity->toString(),
            'type' => $type->value,
            'visible' => $request->visible,
        ];
    }
}
