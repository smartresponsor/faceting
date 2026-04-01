<?php

declare(strict_types=1);

namespace App\Tests\Unit\Report;

use App\Dto\Facet\FacetUpsertRequest;
use App\Service\Report\FacetingReportService;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetingReportServiceTest extends TestCase
{
    public function testBuildDemoFacetReportReturnsExpectedCounts(): void
    {
        $facetService = new class () implements FacetingFacetServiceInterface {
            public function listDemoFacets(): array
            {
                return [
                    ['code' => 'brand', 'name' => 'Brand', 'type' => 'term', 'visible' => true],
                    ['code' => 'price', 'name' => 'Price', 'type' => 'range', 'visible' => true],
                    ['code' => 'campaign_xy', 'name' => 'Campaign xy', 'type' => 'term', 'visible' => false],
                ];
            }

            public function materialize(FacetUpsertRequest $request): array
            {
                return [];
            }
        };

        $report = (new FacetingReportService($facetService))->buildDemoFacetReport();

        self::assertSame(3, $report['total']);
        self::assertSame(2, $report['visible']);
        self::assertSame(1, $report['hidden']);
        self::assertSame(['range' => 1, 'term' => 2], $report['byType']);
    }
}
