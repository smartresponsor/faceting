<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Facet;
use App\Enum\FacetType;
use App\ValueObject\Facet\FacetCode;
use App\ValueObject\Facet\FacetName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class FacetingFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rows = [
            ['brand', 'Brand', FacetType::Term, true, 10],
            ['price', 'Price', FacetType::Range, true, 20],
            ['available', 'Availability', FacetType::Boolean, true, 30],
            ['color', 'Color', FacetType::Term, true, 40],
            ['size', 'Size', FacetType::Term, true, 50],
            ['category_tree', 'Category tree', FacetType::Hierarchy, true, 60],
        ];

        foreach ($rows as [$code, $name, $type, $visible, $position]) {
            $manager->persist(new Facet(
                new FacetCode($code),
                new FacetName($name),
                $type,
                $visible,
                $position,
            ));
        }

        $manager->flush();
    }
}
