<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service;

use App\Faceting\Dto\Facet\FacetUpsertRequest;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\Service\Facet\FacetingFacetService;
use App\Faceting\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetingFacetServiceTest extends TestCase
{
    public function testMaterializeNormalizesCode(): void
    {
        $request = new FacetUpsertRequest();
        $request->code = ' Material-Code ';
        $request->nameEntity = 'Material';
        $request->type = 'term';
        $request->visible = true;

        $repository = new class extends FacetRepository {
            public function __construct()
            {
            }

            public function findOrderedVisibleFacets(): array
            {
                return [];
            }
        };

        $datasetService = new class implements FacetingDemoDatasetServiceInterface {
            public function buildDataset(): array
            {
                return [];
            }
        };

        $result = (new FacetingFacetService($repository, $datasetService))->materialize($request);

        self::assertSame('material-code', $result['code']);
        self::assertSame('Material', $result['nameEntity']);
        self::assertSame('term', $result['type']);
        self::assertTrue($result['visible']);
    }
}
