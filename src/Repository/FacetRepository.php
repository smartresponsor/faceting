<?php

declare(strict_types=1);

namespace App\Faceting\Repository;

use App\Faceting\Entity\FacetEntity;
use App\Faceting\RepositoryInterface\FacetRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Persists Facet entities and provides deterministic visible ordering for Faceting consumers.
 *
 * @extends ServiceEntityRepository<FacetEntity>
 */
class FacetRepository extends ServiceEntityRepository implements FacetRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FacetEntity::class);
    }

    /**
     * @return list<FacetEntity>
     */
    public function findOrderedVisibleFacets(): array
    {
        return $this->createQueryBuilder('facet')
            ->andWhere('facet.visible = :visible')
            ->setParameter('visible', true)
            ->orderBy('facet.position', \SortDirection::Ascending)
            ->addOrderBy('facet.nameEntity', \SortDirection::Ascending)
            ->getQuery()
            ->getResult();
    }

    /**
     * Persists a facet and optionally flushes the current Doctrine unit of work immediately.
     */
    public function save(FacetEntity $facet, bool $flush = false): void
    {
        $this->getEntityManager()->persist($facet);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Removes a facet and optionally flushes the current Doctrine unit of work immediately.
     */
    public function remove(FacetEntity $facet, bool $flush = false): void
    {
        $this->getEntityManager()->remove($facet);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Returns all persisted facets for bounded maintenance operations.
     *
     * @return list<FacetEntity>
     */
    public function findAllFacets(): array
    {
        /** @var list<FacetEntity> $facets */
        $facets = $this->findAll();

        return $facets;
    }

    /**
     * Flushes pending facet persistence and optionally clears the Doctrine unit of work.
     */
    public function flush(bool $clear = false): void
    {
        $this->getEntityManager()->flush();

        if ($clear) {
            $this->getEntityManager()->clear();
        }
    }
}
