<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Aggregation;

use App\Faceting\DTO\Aggregation\FacetAggregationRequestDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use PHPUnit\Framework\TestCase;

final class FacetAggregationRequestDTOTest extends TestCase
{
    public function testItCarriesNeutralCountRequirements(): void
    {
        $request = new FacetAggregationRequestDTO(new FacetCode('brand'), limit: 25, includeZeroCounts: true);

        self::assertSame('brand', $request->facetIdentifier->toString());
        self::assertSame(25, $request->limit);
        self::assertTrue($request->includeZeroCounts);
    }

    public function testItNormalizesFacetValueQuery(): void
    {
        $request = new FacetAggregationRequestDTO(
            new FacetCode('brand'),
            valueQuery: '  acme  ',
        );

        self::assertSame('acme', $request->valueQuery);
    }

    public function testItRejectsEmptyFacetValueQuery(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationRequestDTO(new FacetCode('brand'), valueQuery: '   ');
    }

    public function testItRejectsUnboundedLimit(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationRequestDTO(new FacetCode('brand'), limit: 1001);
    }
}
