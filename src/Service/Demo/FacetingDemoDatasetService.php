<?php

declare(strict_types=1);

namespace App\Service\Demo;

use App\Enum\FacetType;
use App\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use Faker\Factory;

final class FacetingDemoDatasetService implements FacetingDemoDatasetServiceInterface
{
    public function buildDataset(): array
    {
        $faker = Factory::create();
        $faker->seed(20260401);

        return [
            ['code' => 'brand', 'name' => 'Brand', 'type' => FacetType::Term, 'visible' => true, 'position' => 10],
            ['code' => 'price', 'name' => 'Price', 'type' => FacetType::Range, 'visible' => true, 'position' => 20],
            ['code' => 'available', 'name' => 'Availability', 'type' => FacetType::Boolean, 'visible' => true, 'position' => 30],
            ['code' => 'color', 'name' => 'Color', 'type' => FacetType::Term, 'visible' => true, 'position' => 40],
            ['code' => 'size', 'name' => 'Size', 'type' => FacetType::Term, 'visible' => true, 'position' => 50],
            ['code' => 'category_tree', 'name' => 'Category tree', 'type' => FacetType::Hierarchy, 'visible' => true, 'position' => 60],
            ['code' => 'campaign_'.$faker->lexify('??'), 'name' => 'Campaign '.$faker->word(), 'type' => FacetType::Term, 'visible' => false, 'position' => 70],
        ];
    }
}
