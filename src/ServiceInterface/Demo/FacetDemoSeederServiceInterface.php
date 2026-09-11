<?php

declare(strict_types=1);

namespace App\Faceting\ServiceInterface\Demo;

interface FacetDemoSeederServiceInterface
{
    public function replaceDemoData(): int;

    public function clearAll(): int;
}
