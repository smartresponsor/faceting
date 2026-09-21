<?php

declare(strict_types=1);

namespace App\Faceting\Enum;

/**
 * Defines how multiple selected values inside one facet are composed semantically.
 */
enum FacetFilterOperator: string
{
    /**
     * A resource matches when at least one selected facet value is present.
     */
    case Any = 'any';

    /**
     * A resource matches only when every selected facet value is present.
     */
    case All = 'all';
}
