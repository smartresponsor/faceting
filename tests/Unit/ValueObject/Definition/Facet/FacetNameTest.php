<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\ValueObject\Definition\Facet;

use App\Faceting\ValueObject\Definition\Facet\FacetName;
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

    public function testItRejectsOverlongFacetName(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetName(str_repeat('a', 256));
    }
}
