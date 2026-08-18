<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Listing;

use App\Faceting\Dto\Listing\FacetingListingCriteria;
use Symfony\Component\HttpFoundation\Request;

interface FacetingListingCriteriaBuilderServiceInterface
{
    public function buildFromRequest(Request $request): FacetingListingCriteria;
}
