<?php

declare(strict_types=1);

namespace App\Tests\Unit\Listing;

use App\Service\Listing\FacetingListingCriteriaBuilderService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class FacetingListingCriteriaBuilderServiceTest extends TestCase
{
    public function testBuildFromRequestMapsQueryParameters(): void
    {
        $request = new Request([
            'type' => 'term',
            'visible' => 'false',
            'search' => ' Brand ',
        ]);

        $criteria = (new FacetingListingCriteriaBuilderService())->buildFromRequest($request);

        self::assertSame('term', $criteria->type);
        self::assertFalse($criteria->visible);
        self::assertSame('Brand', $criteria->search);
    }
}
