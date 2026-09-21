<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Aggregation;

use App\Faceting\DTO\Aggregation\FacetAggregationBucketDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;
use PHPUnit\Framework\TestCase;

final class FacetAggregationBucketDTOTest extends TestCase
{
    public function testItCarriesValidCountAndPosition(): void
    {
        $bucket = new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), 3, 10);

        self::assertSame(3, $bucket->count);
        self::assertSame(10, $bucket->position);
    }

    public function testItRejectsNegativeCount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), -1);
    }

    public function testItRejectsNegativePosition(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), 0, -1);
    }
}
