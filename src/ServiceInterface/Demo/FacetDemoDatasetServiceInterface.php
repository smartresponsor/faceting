<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Demo;

use App\Faceting\DTO\Demo\FacetDemoDatasetDTO;

interface FacetDemoDatasetServiceInterface
{
    public function buildDataset(): FacetDemoDatasetDTO;
}
