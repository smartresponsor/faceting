<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Report;

use App\Faceting\DTO\Report\FacetReportDTO;

interface FacetReportServiceInterface
{
    public function buildDemoFacetReport(): FacetReportDTO;
}
