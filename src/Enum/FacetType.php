<?php

declare(strict_types=1);

namespace App\Enum;

enum FacetType: string
{
    case Term = 'term';
    case Range = 'range';
    case Boolean = 'boolean';
    case Hierarchy = 'hierarchy';
}
