<?php

declare(strict_types=1);

namespace App\Service\Demo;

use App\Entity\Facet;
use App\Repository\FacetRepository;
use App\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;
use Doctrine\ORM\EntityManagerInterface;

final class FacetingDemoSeederService implements FacetingDemoSeederServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly FacetingDemoDatasetServiceInterface $facetingDemoDatasetService,
        private readonly FacetRepository $facetRepository,
    ) {
    }

    public function replaceDemoData(): int
    {
        $this->clearAll();

        $count = 0;
        foreach ($this->facetingDemoDatasetService->buildDataset() as $row) {
            $this->facetRepository->save(new Facet(
                new FacetCode($row['code']),
                new FacetName($row['name']),
                $row['type'],
                $row['visible'],
                $row['position'],
            ));
            ++$count;
        }

        $this->entityManager->flush();

        return $count;
    }

    public function clearAll(): int
    {
        $count = 0;
        foreach ($this->facetRepository->findAll() as $facet) {
            $this->facetRepository->remove($facet);
            ++$count;
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        return $count;
    }
}
