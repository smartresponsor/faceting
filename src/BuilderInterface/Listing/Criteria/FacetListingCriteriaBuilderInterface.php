<?php

declare(strict_types=1);

namespace App\Faceting\BuilderInterface\Listing\Criteria;

use App\Faceting\DTO\Listing\FacetListingCriteriaDTO;
use Symfony\Component\HttpFoundation\Request;

interface FacetListingCriteriaBuilderInterface
{
    public function buildFromRequest(Request $request): FacetListingCriteriaDTO;
}
