<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Management\Facet;

final class FacetUpsertDTO
{
    public string $code = '';
    public string $nameEntity = '';
    public string $type = 'term';
    public bool $visible = true;
}
