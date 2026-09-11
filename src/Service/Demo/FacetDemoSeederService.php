<?php

declare(strict_types=1);

namespace App\Faceting\Service\Demo;

use App\Faceting\Entity\Facet;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use Doctrine\ORM\EntityManagerInterface;

final class FacetDemoSeederService implements FacetDemoSeederServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly FacetDemoDatasetServiceInterface $facetingDemoDatasetService,
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
                new FacetName($row['nameEntity']),
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
