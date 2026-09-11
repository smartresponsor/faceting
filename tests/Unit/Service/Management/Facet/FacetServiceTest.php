<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Management\Facet;

use App\Faceting\DTO\Demo\FacetDemoDatasetDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\Service\Management\Facet\FacetService;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use PHPUnit\Framework\TestCase;

final class FacetServiceTest extends TestCase
{
    public function testMaterializeNormalizesCode(): void
    {
        $request = new FacetUpsertDTO();
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

        $datasetService = new class implements FacetDemoDatasetServiceInterface {
            public function buildDataset(): FacetDemoDatasetDTO
            {
                return new FacetDemoDatasetDTO([]);
            }
        };

        $result = (new FacetService($repository, $datasetService))->materialize($request);

        self::assertSame('material-code', $result->code);
        self::assertSame('Material', $result->nameEntity);
        self::assertSame('term', $result->type);
        self::assertTrue($result->visible);
    }
}
