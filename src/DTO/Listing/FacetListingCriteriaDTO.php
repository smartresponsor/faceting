<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

final class FacetListingCriteriaDTO
{
    public ?string $type = null;

    public ?bool $visible = true;

    public ?string $search = null;
}
