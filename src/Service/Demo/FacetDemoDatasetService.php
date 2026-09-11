<?php

declare(strict_types=1);

namespace App\Faceting\Service\Demo;

use App\Faceting\DTO\Demo\FacetDemoDatasetDTO;
use App\Faceting\DTO\Demo\FacetDemoRowDTO;
use App\Faceting\Enum\FacetType;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use Faker\Factory;

final class FacetDemoDatasetService implements FacetDemoDatasetServiceInterface
{
    public function buildDataset(): FacetDemoDatasetDTO
    {
        $faker = Factory::create();
        $faker->seed(20260401);

        return new FacetDemoDatasetDTO([
            new FacetDemoRowDTO('brand', 'Brand', FacetType::Term, true, 10),
            new FacetDemoRowDTO('price', 'Price', FacetType::Range, true, 20),
            new FacetDemoRowDTO('available', 'Availability', FacetType::Boolean, true, 30),
            new FacetDemoRowDTO('color', 'Color', FacetType::Term, true, 40),
            new FacetDemoRowDTO('size', 'Size', FacetType::Term, true, 50),
            new FacetDemoRowDTO('category_tree', 'CategoryEntity tree', FacetType::Hierarchy, true, 60),
            new FacetDemoRowDTO('campaign_'.$faker->lexify('??'), 'Campaign '.$faker->word(), FacetType::Term, false, 70),
        ]);
    }
}
