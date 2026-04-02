<?php

declare(strict_types=1);

namespace App\Dto\Listing;

final class FacetingListingResult
{
    /** @var list<array{code:string,name:string,type:string,visible:bool}> */
    public array $items = [];

    public int $total = 0;
}
