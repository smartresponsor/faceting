<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Facet;

use App\Faceting\Dto\Facet\FacetUpsertRequest;

interface FacetingFacetServiceInterface
{
    /**
     * @return list<array{code:string,name:string,type:string,visible:bool}>
     */
    public function listDemoFacets(): array;

    /**
     * @return array{code:string,name:string,type:string,visible:bool}
     */
    public function materialize(FacetUpsertRequest $request): array;
}
