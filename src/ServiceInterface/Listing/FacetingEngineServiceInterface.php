<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Listing;

use App\Faceting\Dto\Listing\FacetingListingCriteria;
use App\Faceting\Dto\Listing\FacetingListingResult;

interface FacetingEngineServiceInterface
{
    public function resolve(FacetingListingCriteria $criteria): FacetingListingResult;
}
