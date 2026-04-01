<?php

declare(strict_types=1);

namespace App\ServiceInterface\Demo;

use App\Enum\FacetType;

interface FacetingDemoDatasetServiceInterface
{
    /**
     * @return list<array{code:string,name:string,type:FacetType,visible:bool,position:int}>
     */
    public function buildDataset(): array;
}
