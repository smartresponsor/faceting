<?php

declare(strict_types=1);

namespace App\Faceting\Service\Demo;

use App\Faceting\Entity\Facet;
use App\Faceting\RepositoryInterface\FacetRepositoryInterface;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;

/**
 * Owns replacement and cleanup of persisted Faceting demonstration data for local runtime use.
 */
final class FacetDemoSeederService implements FacetDemoSeederServiceInterface
{
    /**
     * Initializes demo persistence with Doctrine, dataset, and facet repository collaborators.
     */
    public function __construct(
        private readonly FacetDemoDatasetServiceInterface $facetingDemoDatasetService,
        private readonly FacetRepositoryInterface $facetRepository,
    ) {
    }

    /**
     * Replaces existing rows with the canonical demo dataset and returns the inserted count.
     */
    public function replaceDemoData(): int
    {
        $this->clearAll();

        $count = 0;
        foreach ($this->facetingDemoDatasetService->buildDataset()->items as $row) {
            $this->facetRepository->save(new Facet(
                new FacetCode($row->code),
                new FacetName($row->nameEntity),
                $row->type,
                $row->visible,
                $row->position,
            ));
            ++$count;
        }

        $this->facetRepository->flush();

        return $count;
    }

    /**
     * Removes all persisted facet rows and returns the number removed before clearing Doctrine.
     */
    public function clearAll(): int
    {
        $count = 0;
        foreach ($this->facetRepository->findAllFacets() as $facet) {
            $this->facetRepository->remove($facet);
            ++$count;
        }

        $this->facetRepository->flush(clear: true);

        return $count;
    }
}
