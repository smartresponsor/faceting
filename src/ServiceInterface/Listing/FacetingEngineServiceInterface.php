<?php

declare(strict_types=1);

namespace App\ServiceInterface\Listing;

use App\Dto\Listing\FacetingListingCriteria;
use App\Dto\Listing\FacetingListingResult;

interface FacetingEngineServiceInterface
{
    public function resolve(FacetingListingCriteria $criteria): FacetingListingResult;
}
