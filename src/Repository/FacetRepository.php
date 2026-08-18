<?php

declare(strict_types=1);

namespace App\Faceting\Repository;

use App\Faceting\Entity\Facet;
use App\Faceting\RepositoryInterface\FacetRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FacetRepository extends ServiceEntityRepository implements FacetRepositoryInterface
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
            ->addOrderBy('facet.nameEntity', 'ASC')
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
