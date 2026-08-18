<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\ValueObject;

use App\Faceting\ValueObject\Facet\FacetName;
use PHPUnit\Framework\TestCase;

final class FacetNameTest extends TestCase
{
    public function testItTrimsFacetName(): void
    {
        self::assertSame('Brand', (new FacetName(' Brand '))->toString());
    }

    public function testItRejectsEmptyFacetName(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetName('   ');
    }
}
