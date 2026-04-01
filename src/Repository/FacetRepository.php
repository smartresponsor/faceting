<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Facet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class FacetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facet::class);
    }

    /**
     * @return list<Facet>
     */
    public function findOrderedVisibleFacets(): array
    {
        return $this->createQueryBuilder('facet')
            ->andWhere('facet.visible = :visible')
            ->setParameter('visible', true)
            ->orderBy('facet.position', 'ASC')
            ->addOrderBy('facet.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function save(Facet $facet, bool $flush = false): void
    {
        $this->getEntityManager()->persist($facet);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Facet $facet, bool $flush = false): void
    {
        $this->getEntityManager()->remove($facet);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
