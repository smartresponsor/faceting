<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Listing;

use App\Faceting\DTO\Listing\FacetListingCriteriaDTO;
use App\Faceting\DTO\Management\Facet\FacetCollectionDTO;
use App\Faceting\DTO\Management\Facet\FacetItemDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Service\Listing\FacetEngineService;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetEngineServiceTest extends TestCase
{
    public function testResolveAppliesFilters(): void
    {
        $facetService = new class implements FacetServiceInterface {
            public function listDemoFacets(): FacetCollectionDTO
            {
                return new FacetCollectionDTO([
                    new FacetItemDTO('brand', 'Brand', 'term', true),
                    new FacetItemDTO('price', 'Price', 'range', true),
                    new FacetItemDTO('hidden', 'Hidden', 'term', false),
                ]);
            }

            public function materialize(FacetUpsertDTO $request): FacetItemDTO
            {
                return new FacetItemDTO('test', 'Test', 'term', true);
            }
        };

        $service = new FacetEngineService($facetService);

        $criteria = new FacetListingCriteriaDTO();
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
        $facetService = new class implements FacetServiceInterface {
            public function listDemoFacets(): FacetCollectionDTO
            {
                return new FacetCollectionDTO([
                    new FacetItemDTO('brand', 'Brand', 'term', true),
                    new FacetItemDTO('price', 'Price', 'range', true),
                    new FacetItemDTO('hidden', 'Hidden', 'term', false),
                ]);
            }

            public function materialize(FacetUpsertDTO $request): FacetItemDTO
            {
                return new FacetItemDTO('test', 'Test', 'term', true);
            }
        };

        $service = new FacetEngineService($facetService);

        $criteria = new FacetListingCriteriaDTO();
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
