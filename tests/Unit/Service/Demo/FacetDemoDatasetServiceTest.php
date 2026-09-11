<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Demo;

use App\Faceting\Service\Demo\FacetDemoDatasetService;
use PHPUnit\Framework\TestCase;

final class FacetDemoDatasetServiceTest extends TestCase
{
    public function testBuildDatasetContainsDeterministicRows(): void
    {
        $rows = (new FacetDemoDatasetService())->buildDataset()->items;

        self::assertCount(7, $rows);
        self::assertSame('brand', $rows[0]->code);
        self::assertSame('term', $rows[0]->type->value);
        self::assertFalse($rows[6]->visible);
        self::assertStringStartsWith('campaign_', $rows[6]->code);
    }
}
