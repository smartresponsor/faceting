<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Integration\Container;

use App\Faceting\ServiceInterface\Demo\FacetDemoDatasetServiceInterface;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use App\Faceting\ServiceInterface\Management\Facet\FacetServiceInterface;
use App\Faceting\ServiceInterface\Report\FacetReportServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FacetContainerWiringTest extends KernelTestCase
{
    public function testCoreServicesResolveFromContainer(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        self::assertInstanceOf(FacetServiceInterface::class, $container->get(FacetServiceInterface::class));
        self::assertInstanceOf(FacetReportServiceInterface::class, $container->get(FacetReportServiceInterface::class));
        self::assertInstanceOf(FacetDemoDatasetServiceInterface::class, $container->get(FacetDemoDatasetServiceInterface::class));
        self::assertInstanceOf(FacetDemoSeederServiceInterface::class, $container->get(FacetDemoSeederServiceInterface::class));
    }
}
