<?php

declare(strict_types=1);

namespace App\Dto\Listing;

final class FacetingListingCriteria
{
    public ?string $type = null;

    public ?bool $visible = true;

    public ?string $search = null;
}
