<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Filter;

use App\Faceting\DTO\Filter\FacetFilterDTO;
use App\Faceting\Enum\FacetFilterOperator;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;
use PHPUnit\Framework\TestCase;

final class FacetFilterDTOTest extends TestCase
{
    public function testItCarriesMultiValueSelectionSemanticsWithoutExecutingQuery(): void
    {
        $filter = new FacetFilterDTO(
            new FacetCode('brand'),
            [
                new FacetValueIdentifier('brand:nike'),
                new FacetValueIdentifier('brand:adidas'),
            ],
            FacetFilterOperator::Any,
        );

        self::assertSame('brand', $filter->facetIdentifier->toString());
        self::assertSame(FacetFilterOperator::Any, $filter->operator);
        self::assertSame(
            ['brand:nike', 'brand:adidas'],
            array_map(static fn (FacetValueIdentifier $identifier): string => $identifier->toString(), $filter->valueIdentifiers),
        );
    }

    public function testItRejectsEmptySelection(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetFilterDTO(new FacetCode('brand'), []);
    }

    public function testItRejectsDuplicateStableValues(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetFilterDTO(
            new FacetCode('brand'),
            [
                new FacetValueIdentifier('brand:nike'),
                new FacetValueIdentifier('BRAND:NIKE'),
            ],
        );
    }
}
