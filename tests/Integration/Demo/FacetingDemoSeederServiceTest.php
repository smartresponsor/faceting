<?php

declare(strict_types=1);

namespace App\Tests\Integration\Demo;

use App\Entity\Facet;
use App\Repository\FacetRepository;
use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FacetingDemoSeederServiceTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();
        $this->entityManager = $container->get(EntityManagerInterface::class);

        $metadata = [$this->entityManager->getClassMetadata(Facet::class)];
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    public function testReplaceDemoDataAndClearAll(): void
    {
        $container = static::getContainer();
        $seeder = $container->get(FacetingDemoSeederServiceInterface::class);
        $repository = $container->get(FacetRepository::class);

        self::assertSame(7, $seeder->replaceDemoData());
        self::assertCount(6, $repository->findOrderedVisibleFacets());
        self::assertSame(7, $seeder->clearAll());
        self::assertCount(0, $repository->findOrderedVisibleFacets());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if (isset($this->entityManager)) {
            $this->entityManager->close();
        }
    }
}
