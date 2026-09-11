<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Report;

use App\Faceting\DTO\Management\Facet\FacetCollectionDTO;
use App\Faceting\DTO\Management\Facet\FacetItemDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Service\Report\FacetReportService;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetReportServiceTest extends TestCase
{
    public function testBuildDemoFacetReportReturnsExpectedCounts(): void
    {
        $facetService = new class implements FacetServiceInterface {
            public function listDemoFacets(): FacetCollectionDTO
            {
                return new FacetCollectionDTO([
                    new FacetItemDTO('brand', 'Brand', 'term', true),
                    new FacetItemDTO('price', 'Price', 'range', true),
                    new FacetItemDTO('campaign_xy', 'Campaign xy', 'term', false),
                ]);
            }

            public function materialize(FacetUpsertDTO $request): FacetItemDTO
            {
                return new FacetItemDTO('test', 'Test', 'term', true);
            }
        };

        $report = (new FacetReportService($facetService))->buildDemoFacetReport();

        self::assertSame(3, $report->total);
        self::assertSame(2, $report->visible);
        self::assertSame(1, $report->hidden);
        self::assertSame(['range' => 1, 'term' => 2], $report->byType);
    }
}
