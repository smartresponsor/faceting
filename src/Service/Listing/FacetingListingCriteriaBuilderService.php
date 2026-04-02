<?php

declare(strict_types=1);

namespace App\Service\Listing;

use App\Dto\Listing\FacetingListingCriteria;
use App\ServiceInterface\Listing\FacetingListingCriteriaBuilderServiceInterface;
use Symfony\Component\HttpFoundation\Request;

final class FacetingListingCriteriaBuilderService implements FacetingListingCriteriaBuilderServiceInterface
{
    public function buildFromRequest(Request $request): FacetingListingCriteria
    {
        $criteria = new FacetingListingCriteria();

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
