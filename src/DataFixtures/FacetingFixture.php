<?php

declare(strict_types=1);

namespace App\Faceting\DataFixtures;

use App\Faceting\Entity\Facet;
use App\Faceting\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\Faceting\ValueObject\Facet\FacetCode;
use App\Faceting\ValueObject\Facet\FacetName;
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
                new FacetName($row['nameEntity']),
                $row['type'],
                $row['visible'],
                $row['position'],
            ));
        }

        $manager->flush();
    }
}
