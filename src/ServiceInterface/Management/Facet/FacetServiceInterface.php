<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Management\Facet;

use App\Faceting\DTO\Management\Facet\FacetCollectionDTO;
use App\Faceting\DTO\Management\Facet\FacetItemDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;

interface FacetServiceInterface
{
    public function listDemoFacets(): FacetCollectionDTO;

    public function materialize(FacetUpsertDTO $request): FacetItemDTO;
}
