<?php

declare(strict_types=1);

namespace App\Faceting\Dto\Facet;

final class FacetUpsertRequest
{
    public string $code = '';
    public string $nameEntity = '';
    public string $type = 'term';
    public bool $visible = true;
}
