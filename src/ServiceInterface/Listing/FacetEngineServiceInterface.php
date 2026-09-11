<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Listing;

use App\Faceting\DTO\Listing\FacetListingCriteriaDTO;
use App\Faceting\DTO\Listing\FacetListingResultDTO;

interface FacetEngineServiceInterface
{
    public function resolve(FacetListingCriteriaDTO $criteria): FacetListingResultDTO;
}
