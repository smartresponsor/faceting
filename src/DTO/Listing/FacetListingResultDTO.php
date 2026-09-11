<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Listing;

final class FacetListingResultDTO
{
    /** @var list<array{code:string,nameEntity:string,type:string,visible:bool}> */
    public array $items = [];

    public int $total = 0;

    public FacetAggregationResultDTO $aggregations;

    public function __construct()
    {
        $this->aggregations = new FacetAggregationResultDTO();
    }
}
