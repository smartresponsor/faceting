<?php

declare(strict_types=1);

namespace App\Faceting\Builder\Listing\Criteria;

use App\Faceting\BuilderInterface\Listing\Criteria\FacetListingCriteriaBuilderInterface;
use App\Faceting\DTO\Listing\FacetListingCriteriaDTO;
use Symfony\Component\HttpFoundation\Request;

/**
 * Builds typed facet listing criteria from HTTP query parameters for listing operations.
 */
final class FacetListingCriteriaBuilder implements FacetListingCriteriaBuilderInterface
{
    /**
     * Converts supported request query parameters into the canonical listing criteria DTO.
     */
    public function buildFromRequest(Request $request): FacetListingCriteriaDTO
    {
        $criteria = new FacetListingCriteriaDTO();

        $type = $request->query->getString('type');
        $criteria->type = '' !== $type ? $type : null;

        $visible = $request->query->get('visible');
        if (null === $visible || '' === $visible) {
            $criteria->visible = true;
        } else {
            $criteria->visible = filter_var($visible, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
        }

        $search = trim($request->query->getString('search'));
        $criteria->search = '' !== $search ? $search : null;

        return $criteria;
    }
}
