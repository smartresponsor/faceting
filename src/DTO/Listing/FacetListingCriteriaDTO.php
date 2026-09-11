<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

/**
 * Defines the stable typed criteria accepted by the Faceting listing engine.
 */
final class FacetListingCriteriaDTO
{
    public ?string $type = null;

    public ?bool $visible = true;

    public ?string $search = null;
}
