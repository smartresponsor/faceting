<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Builder\Listing\Criteria;

use App\Faceting\Builder\Listing\Criteria\FacetListingCriteriaBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class FacetListingCriteriaBuilderTest extends TestCase
{
    public function testBuildFromRequestMapsQueryParameters(): void
    {
        $request = new Request([
            'type' => 'term',
            'visible' => 'false',
            'search' => ' Brand ',
        ]);

        $criteria = (new FacetListingCriteriaBuilder())->buildFromRequest($request);

        self::assertSame('term', $criteria->type);
        self::assertFalse($criteria->visible);
        self::assertSame('Brand', $criteria->search);
    }
}
