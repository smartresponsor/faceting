<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\ValueObject\Definition\Facet;

use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;
use PHPUnit\Framework\TestCase;

final class FacetValueIdentifierTest extends TestCase
{
    public function testItNormalizesStableIdentifier(): void
    {
        self::assertSame('brand:nike-us', (new FacetValueIdentifier(' Brand:Nike-US '))->toString());
    }

    public function testItRejectsOversizedIdentifier(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueIdentifier(str_repeat('a', 129));
    }

    public function testItRejectsInvalidIdentifierCharacters(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueIdentifier('Nike Shoes');
    }

    public function testItRejectsEmptyIdentifier(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueIdentifier('   ');
    }
}
