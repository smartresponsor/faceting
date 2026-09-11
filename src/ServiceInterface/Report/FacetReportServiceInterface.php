<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Report;

interface FacetReportServiceInterface
{
    /**
     * @return array{
     *   total:int,
     *   visible:int,
     *   hidden:int,
     *   byType:array<string,int>
     * }
     */
    public function buildDemoFacetReport(): array;
}
