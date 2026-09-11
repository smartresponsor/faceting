<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Report;

use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Service\Report\FacetReportService;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetReportServiceTest extends TestCase
{
    public function testBuildDemoFacetReportReturnsExpectedCounts(): void
    {
        $facetService = new class implements FacetServiceInterface {
            public function listDemoFacets(): array
            {
                return [
                    ['code' => 'brand', 'nameEntity' => 'Brand', 'type' => 'term', 'visible' => true],
                    ['code' => 'price', 'nameEntity' => 'Price', 'type' => 'range', 'visible' => true],
                    ['code' => 'campaign_xy', 'nameEntity' => 'Campaign xy', 'type' => 'term', 'visible' => false],
                ];
            }

            public function materialize(FacetUpsertDTO $request): array
            {
                return ['code' => 'test', 'nameEntity' => 'Test', 'type' => 'term', 'visible' => true];
            }
        };

        $report = (new FacetReportService($facetService))->buildDemoFacetReport();

        self::assertSame(3, $report['total']);
        self::assertSame(2, $report['visible']);
        self::assertSame(1, $report['hidden']);
        self::assertSame(['range' => 1, 'term' => 2], $report['byType']);
    }
}
