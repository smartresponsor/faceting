<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Filter;

use App\Faceting\DTO\Filter\FacetNumericRangeFilterDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use PHPUnit\Framework\TestCase;

final class FacetNumericRangeFilterDTOTest extends TestCase
{
    public function testItCarriesInclusiveAndExclusiveNumericBoundaries(): void
    {
        $range = new FacetNumericRangeFilterDTO(
            new FacetCode('price'),
            minimum: 10.5,
            maximum: 100,
            minimumInclusive: true,
            maximumInclusive: false,
        );

        self::assertSame(10.5, $range->minimum);
        self::assertSame(100, $range->maximum);
        self::assertTrue($range->minimumInclusive);
        self::assertFalse($range->maximumInclusive);
    }

    public function testItRejectsMissingBoundaries(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetNumericRangeFilterDTO(new FacetCode('price'));
    }

    public function testItRejectsInvertedRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetNumericRangeFilterDTO(new FacetCode('price'), 20, 10);
    }
}
