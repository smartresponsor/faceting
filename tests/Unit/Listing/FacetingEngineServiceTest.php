<?php

declare(strict_types=1);

namespace App\Tests\Unit\Listing;

use App\Dto\Facet\FacetUpsertRequest;
use App\Dto\Listing\FacetingListingCriteria;
use App\Service\Listing\FacetingEngineService;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetingEngineServiceTest extends TestCase
{
    public function testResolveAppliesFilters(): void
    {
        $facetService = new class () implements FacetingFacetServiceInterface {
            public function listDemoFacets(): array
            {
                return [
                    ['code' => 'brand', 'name' => 'Brand', 'type' => 'term', 'visible' => true],
                    ['code' => 'price', 'name' => 'Price', 'type' => 'range', 'visible' => true],
                    ['code' => 'hidden', 'name' => 'Hidden', 'type' => 'term', 'visible' => false],
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
    }
}
