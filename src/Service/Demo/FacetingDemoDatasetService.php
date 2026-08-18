<?php

declare(strict_types=1);

namespace App\Faceting\Service\Demo;

use App\Faceting\Enum\FacetType;
use App\Faceting\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use Faker\Factory;

final class FacetingDemoDatasetService implements FacetingDemoDatasetServiceInterface
{
    public function buildDataset(): array
    {
        $faker = Factory::create();
        $faker->seed(20260401);

        return [
            ['code' => 'brand', 'nameEntity' => 'Brand', 'type' => FacetType::Term, 'visible' => true, 'position' => 10],
            ['code' => 'price', 'nameEntity' => 'Price', 'type' => FacetType::Range, 'visible' => true, 'position' => 20],
            ['code' => 'available', 'nameEntity' => 'Availability', 'type' => FacetType::Boolean, 'visible' => true, 'position' => 30],
            ['code' => 'color', 'nameEntity' => 'Color', 'type' => FacetType::Term, 'visible' => true, 'position' => 40],
            ['code' => 'size', 'nameEntity' => 'Size', 'type' => FacetType::Term, 'visible' => true, 'position' => 50],
            ['code' => 'category_tree', 'nameEntity' => 'CategoryEntity tree', 'type' => FacetType::Hierarchy, 'visible' => true, 'position' => 60],
            ['code' => 'campaign_'.$faker->lexify('??'), 'nameEntity' => 'Campaign '.$faker->word(), 'type' => FacetType::Term, 'visible' => false, 'position' => 70],
        ];
    }
}
