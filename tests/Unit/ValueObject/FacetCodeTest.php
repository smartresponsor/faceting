<?php

declare(strict_types=1);

namespace App\Tests\Unit\ValueObject;

use App\ValueObject\Facet\FacetCode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class FacetCodeTest extends TestCase
{
    public function testItNormalizesToLowercase(): void
    {
        self::assertSame('brand_code', (new FacetCode(' Brand_Code '))->toString());
    }

    public function testItRejectsInvalidCharacters(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new FacetCode('Brand Name');
    }
}
