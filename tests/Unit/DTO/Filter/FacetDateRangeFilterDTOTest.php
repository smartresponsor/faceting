<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Filter;

use App\Faceting\DTO\Filter\FacetDateRangeFilterDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use PHPUnit\Framework\TestCase;

final class FacetDateRangeFilterDTOTest extends TestCase
{
    public function testItCarriesImmutableDateBoundaries(): void
    {
        $minimum = new \DateTimeImmutable('2026-01-01T00:00:00+00:00');
        $maximum = new \DateTimeImmutable('2026-12-31T23:59:59+00:00');

        $range = new FacetDateRangeFilterDTO(new FacetCode('released_at'), $minimum, $maximum);

        self::assertSame($minimum, $range->minimum);
        self::assertSame($maximum, $range->maximum);
    }

    public function testItRejectsMissingBoundaries(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetDateRangeFilterDTO(new FacetCode('released_at'));
    }

    public function testItRejectsInvertedRange(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetDateRangeFilterDTO(
            new FacetCode('released_at'),
            new \DateTimeImmutable('2026-12-31'),
            new \DateTimeImmutable('2026-01-01'),
        );
    }
}
