<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Facet;
use App\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class FacetingFixture extends Fixture
{
    public function __construct(
        private readonly FacetingDemoDatasetServiceInterface $facetingDemoDatasetService,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->facetingDemoDatasetService->buildDataset() as $row) {
            $manager->persist(new Facet(
                new FacetCode($row['code']),
                new FacetName($row['name']),
                $row['type'],
                $row['visible'],
                $row['position'],
            ));
        }

        $manager->flush();
    }
}
