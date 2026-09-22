<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Integration\Demo;

use App\Faceting\Entity\FacetEntity;
use App\Faceting\Enum\FacetType;
use App\Faceting\Repository\FacetRepository;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FacetDemoSeederServiceTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();
        $entityManager = $container->get(EntityManagerInterface::class);
        self::assertInstanceOf(EntityManagerInterface::class, $entityManager);
        $this->entityManager = $entityManager;

        $metadata = [$this->entityManager->getClassMetadata(FacetEntity::class)];
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    public function testReplaceDemoDataAndClearAll(): void
    {
        $container = static::getContainer();
        $seeder = $container->get(FacetDemoSeederServiceInterface::class);
        $repository = $container->get(FacetRepository::class);
        self::assertInstanceOf(FacetDemoSeederServiceInterface::class, $seeder);
        self::assertInstanceOf(FacetRepository::class, $repository);

        self::assertSame(7, $seeder->replaceDemoData());
        self::assertCount(6, $repository->findOrderedVisibleFacets());
        self::assertSame(7, $seeder->clearAll());
        self::assertCount(0, $repository->findOrderedVisibleFacets());
    }

    public function testRepositoryCanFlushSaveAndRemoveImmediately(): void
    {
        $repository = static::getContainer()->get(FacetRepository::class);
        self::assertInstanceOf(FacetRepository::class, $repository);

        $facet = new FacetEntity(
            new FacetCode('integration'),
            new FacetName('Integration'),
            FacetType::Term,
        );

        $repository->save($facet, true);
        self::assertCount(1, $repository->findOrderedVisibleFacets());
        $repository->remove($facet, true);
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
