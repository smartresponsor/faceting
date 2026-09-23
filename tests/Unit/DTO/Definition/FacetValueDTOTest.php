<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Definition;

use App\Faceting\DTO\Definition\FacetValueDTO;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;
use PHPUnit\Framework\TestCase;

final class FacetValueDTOTest extends TestCase
{
    public function testItKeepsStableIdentifierSeparateFromCatalogReferenceAndLabel(): void
    {
        $value = new FacetValueDTO(
            new FacetCode('brand'),
            new FacetValueIdentifier('brand:nike'),
            ' Nike ',
            position: 5,
            externalReference: 'catalog-brand:42',
        );

        self::assertSame('brand:nike', $value->identifier->toString());
        self::assertSame('Nike', $value->label);
        self::assertSame('catalog-brand:42', $value->externalReference);
        self::assertSame(5, $value->position);
    }

    public function testItRejectsNegativePosition(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueDTO(new FacetCode('brand'), new FacetValueIdentifier('brand:nike'), 'Nike', position: -1);
    }

    public function testItRejectsBlankExternalReference(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueDTO(new FacetCode('brand'), new FacetValueIdentifier('brand:nike'), 'Nike', externalReference: '   ');
    }

    public function testItRejectsBlankLabel(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetValueDTO(
            new FacetCode('brand'),
            new FacetValueIdentifier('brand:nike'),
            '   ',
        );
    }
}
