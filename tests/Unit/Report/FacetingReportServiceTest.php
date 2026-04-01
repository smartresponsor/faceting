<?php

declare(strict_types=1);

namespace App\Tests\Unit\Report;

use App\Service\Facet\FacetingFacetService;
use App\Service\Report\FacetingReportService;
use PHPUnit\Framework\TestCase;

final class FacetingReportServiceTest extends TestCase
{
    public function testBuildDemoFacetReportReturnsExpectedCounts(): void
    {
        $report = (new FacetingReportService(new FacetingFacetService()))->buildDemoFacetReport();

        self::assertSame(3, $report['total']);
        self::assertSame(3, $report['visible']);
        self::assertSame(0, $report['hidden']);
        self::assertSame(['boolean' => 1, 'range' => 1, 'term' => 1], $report['byType']);
    }
}
