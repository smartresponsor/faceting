<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Aggregation;

use App\Faceting\DTO\Aggregation\FacetAggregationBucketDTO;
use App\Faceting\DTO\Aggregation\FacetAggregationResultDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;
use PHPUnit\Framework\TestCase;

final class FacetAggregationResultDTOTest extends TestCase
{
    public function testItCarriesStableValueCountsIndependentOfBackend(): void
    {
        $result = new FacetAggregationResultDTO(
            new FacetCode('brand'),
            [
                new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), 12, 10),
                new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:adidas'), 8, 20),
            ],
            matchedResourceCount: 20,
        );

        self::assertSame('brand', $result->facetIdentifier->toString());
        self::assertSame(20, $result->matchedResourceCount);
        self::assertSame(12, $result->buckets[0]->count);
        self::assertSame('brand:nike', $result->buckets[0]->valueIdentifier->toString());
    }

    public function testItRejectsNegativeMatchedResourceCount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationResultDTO(new FacetCode('brand'), [], matchedResourceCount: -1);
    }

    public function testItRejectsDuplicateValueIdentifiers(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationResultDTO(
            new FacetCode('brand'),
            [
                new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), 1),
                new FacetAggregationBucketDTO(new FacetValueIdentifier('BRAND:NIKE'), 1),
            ],
            matchedResourceCount: 1,
        );
    }

    public function testItRejectsBucketCountGreaterThanMatchedResources(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetAggregationResultDTO(
            new FacetCode('brand'),
            [new FacetAggregationBucketDTO(new FacetValueIdentifier('brand:nike'), 2)],
            matchedResourceCount: 1,
        );
    }
}
