<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Dto\Facet\FacetUpsertRequest;
use App\Service\Facet\FacetingFacetService;
use PHPUnit\Framework\TestCase;

final class FacetingFacetServiceTest extends TestCase
{
    public function testMaterializeNormalizesCode(): void
    {
        $request = new FacetUpsertRequest();
        $request->code = ' Material-Code ';
        $request->name = 'Material';
        $request->type = 'term';
        $request->visible = true;

        $result = (new FacetingFacetService())->materialize($request);

        self::assertSame('material-code', $result['code']);
        self::assertSame('Material', $result['name']);
        self::assertSame('term', $result['type']);
        self::assertTrue($result['visible']);
    }
}
