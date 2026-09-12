<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Service\Management\Facet;

use App\Faceting\DTO\Demo\FacetDemoDatasetDTO;
use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;
use App\Faceting\Entity\Facet;
use App\Faceting\Enum\FacetType;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\Service\Management\Facet\FacetService;
use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
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

    public function testListDemoFacetsPrefersPersistedVisibleFacets(): void
    {
        $repository = new class extends FacetRepository {
            public function __construct()
            {
            }

            public function findOrderedVisibleFacets(): array
            {
                return [new Facet(
                    new FacetCode('persisted'),
                    new FacetName('Persisted'),
                    FacetType::Range,
                )];
            }
        };

        $datasetService = new class implements FacetDemoDatasetServiceInterface {
            public function buildDataset(): FacetDemoDatasetDTO
            {
                throw new \LogicException('Fallback dataset must not be read when persisted facets exist.');
            }
        };

        $result = (new FacetService($repository, $datasetService))->listDemoFacets();

        self::assertCount(1, $result->items);
        self::assertSame('persisted', $result->items[0]->code);
        self::assertSame('Persisted', $result->items[0]->nameEntity);
        self::assertSame('range', $result->items[0]->type);
        self::assertTrue($result->items[0]->visible);
    }
}
