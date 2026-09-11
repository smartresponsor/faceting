<?php

declare(strict_types=1);

namespace App\Faceting\Service\Management\Facet;

use App\Faceting\DTO\Management\Facet\FacetCollectionDTO;
use App\Faceting\DTO\Management\Facet\FacetItemDTO;
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

    public function listDemoFacets(): FacetCollectionDTO
    {
        $items = [];
        foreach ($this->facetRepository->findOrderedVisibleFacets() as $facet) {
            $items[] = new FacetItemDTO(
                $facet->getCode()->toString(),
                $facet->getName()->toString(),
                $facet->getType()->value,
                $facet->isVisible(),
            );
        }

        if ([] !== $items) {
            return new FacetCollectionDTO($items);
        }

        foreach ($this->facetingDemoDatasetService->buildDataset()->items as $row) {
            if (true !== $row->visible) {
                continue;
            }

            $items[] = new FacetItemDTO(
                $row->code,
                $row->nameEntity,
                $row->type->value,
                $row->visible,
            );
        }

        return new FacetCollectionDTO($items);
    }

    public function materialize(FacetUpsertDTO $request): FacetItemDTO
    {
        $code = new FacetCode($request->code);
        $nameEntity = new FacetName($request->nameEntity);
        $type = FacetType::from($request->type);

        return new FacetItemDTO(
            $code->toString(),
            $nameEntity->toString(),
            $type->value,
            $request->visible,
        );
    }
}
