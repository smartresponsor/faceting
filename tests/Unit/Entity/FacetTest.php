<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Entity;

use App\Faceting\Entity\FacetEntity;
use App\Faceting\Enum\FacetType;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use PHPUnit\Framework\TestCase;

final class FacetTest extends TestCase
{
    public function testFacetExposesAndMutatesItsBusinessState(): void
    {
        $facet = new FacetEntity(
            new FacetCode('brand'),
            new FacetName('Brand'),
            FacetType::Term,
            visible: true,
            position: 10,
        );

        self::assertNull($facet->getId());
        self::assertSame('brand', $facet->getCode()->toString());
        self::assertSame('Brand', $facet->getName()->toString());
        self::assertSame(FacetType::Term, $facet->getType());
        self::assertTrue($facet->isVisible());
        self::assertSame(10, $facet->getPosition());

        $facet->rename(new FacetName('Manufacturer'));
        $facet->changeType(FacetType::Hierarchy);
        $facet->changeVisibility(false);
        $facet->reposition(20);

        self::assertSame('Manufacturer', $facet->getName()->toString());
        self::assertSame(FacetType::Hierarchy, $facet->getType());
        self::assertFalse($facet->isVisible());
        self::assertSame(20, $facet->getPosition());
        self::assertNotNull($facet->getModifiedAt());
    }
}
