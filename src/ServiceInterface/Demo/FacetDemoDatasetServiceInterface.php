<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Demo;

use App\Faceting\Enum\FacetType;

interface FacetDemoDatasetServiceInterface
{
    /**
     * @return list<array{code:string,nameEntity:string,type:FacetType,visible:bool,position:int}>
     */
    public function buildDataset(): array;
}
