<?php

declare(strict_types=1);

namespace App\Faceting\DataFixtures;

use App\Faceting\Entity\Facet;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class FacetFixture extends Fixture
{
    public function __construct(
        private readonly FacetDemoDatasetServiceInterface $facetingDemoDatasetService,
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
