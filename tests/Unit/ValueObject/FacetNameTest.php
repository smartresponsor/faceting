<?php

declare(strict_types=1);

namespace App\Tests\Unit\ValueObject;

use App\ValueObject\Facet\FacetName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class FacetNameTest extends TestCase
{
    public function testItTrimsFacetName(): void
    {
        self::assertSame('Brand', (new FacetName(' Brand '))->toString());
    }

    public function testItRejectsEmptyFacetName(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new FacetName('   ');
    }
}
