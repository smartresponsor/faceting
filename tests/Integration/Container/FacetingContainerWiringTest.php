<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Integration\Container;

use App\Faceting\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\Faceting\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use App\Faceting\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\Faceting\ServiceInterface\Report\FacetingReportServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FacetingContainerWiringTest extends KernelTestCase
{
    public function testCoreServicesResolveFromContainer(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        self::assertInstanceOf(FacetingFacetServiceInterface::class, $container->get(FacetingFacetServiceInterface::class));
        self::assertInstanceOf(FacetingReportServiceInterface::class, $container->get(FacetingReportServiceInterface::class));
        self::assertInstanceOf(FacetingDemoDatasetServiceInterface::class, $container->get(FacetingDemoDatasetServiceInterface::class));
        self::assertInstanceOf(FacetingDemoSeederServiceInterface::class, $container->get(FacetingDemoSeederServiceInterface::class));
    }
}
