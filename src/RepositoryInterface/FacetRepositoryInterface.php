<?php

declare(strict_types=1);

namespace App\Faceting\RepositoryInterface;

use App\Faceting\Entity\Facet;

interface FacetRepositoryInterface
{
    /**
     * @return list<Facet>
     */
    public function findOrderedVisibleFacets(): array;

    public function save(Facet $facet, bool $flush = false): void;

    public function remove(Facet $facet, bool $flush = false): void;
}
