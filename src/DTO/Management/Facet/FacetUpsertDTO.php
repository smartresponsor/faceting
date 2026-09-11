<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

/**
 * Captures validated management input required to preview or materialize a facet definition.
 */
final class FacetUpsertDTO
{
    public string $code = '';
    public string $nameEntity = '';
    public string $type = 'term';
    public bool $visible = true;
}
