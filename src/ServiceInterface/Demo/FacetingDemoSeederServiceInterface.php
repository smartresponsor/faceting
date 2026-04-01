<?php

declare(strict_types=1);

namespace App\ServiceInterface\Demo;

interface FacetingDemoSeederServiceInterface
{
    public function replaceDemoData(): int;

    public function clearAll(): int;
}
