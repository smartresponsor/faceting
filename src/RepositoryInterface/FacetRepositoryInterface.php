<?php

declare(strict_types=1);

namespace App\Faceting\RepositoryInterface;

use App\Faceting\Entity\Facet;

/**
 * Defines persistence operations owned by the Faceting aggregate repository.
 */
interface FacetRepositoryInterface
{
    /**
     * Returns visible facets in the repository's deterministic display order.
     *
     * @return list<Facet>
     */
    public function findOrderedVisibleFacets(): array;

    /**
     * Persists a facet and optionally flushes the current Doctrine unit of work.
     */
    public function save(Facet $facet, bool $flush = false): void;

    /**
     * Removes a facet and optionally flushes the current Doctrine unit of work.
     */
    public function remove(Facet $facet, bool $flush = false): void;

    /**
     * Returns all facets for bounded maintenance operations.
     *
     * @return list<Facet>
     */
    public function findAllFacets(): array;

    /**
     * Flushes pending facet persistence and optionally clears the Doctrine unit of work.
     */
    public function flush(bool $clear = false): void;
}
