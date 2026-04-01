<?php

declare(strict_types=1);

namespace App\Tests\Unit\Demo;

use App\Service\Demo\FacetingDemoDatasetService;
use PHPUnit\Framework\TestCase;

final class FacetingDemoDatasetServiceTest extends TestCase
{
    public function testBuildDatasetContainsDeterministicRows(): void
    {
        $rows = (new FacetingDemoDatasetService())->buildDataset();

        self::assertCount(7, $rows);
        self::assertSame('brand', $rows[0]['code']);
        self::assertSame('term', $rows[0]['type']->value);
        self::assertFalse($rows[6]['visible']);
        self::assertStringStartsWith('campaign_', $rows[6]['code']);
    }
}
