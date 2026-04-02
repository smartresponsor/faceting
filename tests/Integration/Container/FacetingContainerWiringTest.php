<?php

declare(strict_types=1);

namespace App\Tests\Integration\Container;

use App\ServiceInterface\Demo\FacetingDemoDatasetServiceInterface;
use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use App\ServiceInterface\Facet\FacetingFacetServiceInterface;
use App\ServiceInterface\Report\FacetingReportServiceInterface;
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
