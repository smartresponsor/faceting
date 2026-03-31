<?php

declare(strict_types=1);

namespace App\Dto\Facet;

final class FacetUpsertRequest
{
    public string $code = '';
    public string $name = '';
    public string $type = 'term';
    public bool $visible = true;
}
