<?php

declare(strict_types=1);

namespace App\Faceting\Enum;

/**
 * Defines the supported facet classification vocabulary consumed by Faceting operations.
 */
enum FacetType: string
{
    case Term = 'term';
    case Range = 'range';
    case Boolean = 'boolean';
    case Hierarchy = 'hierarchy';
}
