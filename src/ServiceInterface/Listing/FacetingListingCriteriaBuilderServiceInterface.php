<?php

declare(strict_types=1);

namespace App\ServiceInterface\Listing;

use App\Dto\Listing\FacetingListingCriteria;
use Symfony\Component\HttpFoundation\Request;

interface FacetingListingCriteriaBuilderServiceInterface
{
    public function buildFromRequest(Request $request): FacetingListingCriteria;
}
