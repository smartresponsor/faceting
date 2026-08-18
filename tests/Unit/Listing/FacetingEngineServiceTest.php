<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Listing;

use App\Faceting\Dto\Facet\FacetUpsertRequest;
use App\Faceting\Dto\Listing\FacetingListingCriteria;
use App\Faceting\Service\Listing\FacetingEngineService;
use App\Faceting\ServiceInterface\Facet\FacetingFacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetingEngineServiceTest extends TestCase
{
    public function testResolveAppliesFilters(): void
    {
        $facetService = new class implements FacetingFacetServiceInterface {
            public function listDemoFacets(): array
            {
                return [
                    ['code' => 'brand', 'nameEntity' => 'Brand', 'type' => 'term', 'visible' => true],
                    ['code' => 'price', 'nameEntity' => 'Price', 'type' => 'range', 'visible' => true],
                    ['code' => 'hidden', 'nameEntity' => 'Hidden', 'type' => 'term', 'visible' => false],
                ];
            }

            public function materialize(FacetUpsertRequest $request): array
            {
                return [];
            }
        };

        $service = new FacetingEngineService($facetService);

        $criteria = new FacetingListingCriteria();
        $criteria->type = 'term';
        $criteria->visible = true;

        $result = $service->resolve($criteria);

        self::assertSame(1, $result->total);
        self::assertSame('brand', $result->items[0]['code']);

        self::assertCount(1, $result->aggregations->types);
        self::assertSame('term', $result->aggregations->types[0]->key);
        self::assertSame(1, $result->aggregations->types[0]->count);

        self::assertCount(1, $result->aggregations->visibility);
        self::assertSame('visible', $result->aggregations->visibility[0]->key);
        self::assertSame(1, $result->aggregations->visibility[0]->count);
    }

    public function testResolveBuildsAggregationsForUnfilteredListing(): void
    {
        $facetService = new class implements FacetingFacetServiceInterface {
            public function listDemoFacets(): array
            {
                return [
                    ['code' => 'brand', 'nameEntity' => 'Brand', 'type' => 'term', 'visible' => true],
                    ['code' => 'price', 'nameEntity' => 'Price', 'type' => 'range', 'visible' => true],
                    ['code' => 'hidden', 'nameEntity' => 'Hidden', 'type' => 'term', 'visible' => false],
                ];
            }

            public function materialize(FacetUpsertRequest $request): array
            {
                return [];
            }
        };

        $service = new FacetingEngineService($facetService);

        $criteria = new FacetingListingCriteria();
        $criteria->visible = null;

        $result = $service->resolve($criteria);

        self::assertSame(3, $result->total);

        self::assertCount(2, $result->aggregations->types);
        self::assertSame('term', $result->aggregations->types[0]->key);
        self::assertSame(2, $result->aggregations->types[0]->count);
        self::assertSame('range', $result->aggregations->types[1]->key);
        self::assertSame(1, $result->aggregations->types[1]->count);

        self::assertCount(2, $result->aggregations->visibility);
        self::assertSame('visible', $result->aggregations->visibility[0]->key);
        self::assertSame(2, $result->aggregations->visibility[0]->count);
        self::assertSame('hidden', $result->aggregations->visibility[1]->key);
        self::assertSame(1, $result->aggregations->visibility[1]->count);
    }
}
