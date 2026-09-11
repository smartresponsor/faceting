<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Management\Facet;

use App\Faceting\DTO\Management\Facet\FacetUpsertDTO;

interface FacetServiceInterface
{
    /**
     * @return list<array{code:string,nameEntity:string,type:string,visible:bool}>
     */
    public function listDemoFacets(): array;

    /**
     * @return array{code:string,nameEntity:string,type:string,visible:bool}
     */
    public function materialize(FacetUpsertDTO $request): array;
}
