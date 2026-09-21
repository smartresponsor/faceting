<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Definition;

use App\Faceting\DTO\Definition\FacetDefinitionDTO;
use App\Faceting\Enum\FacetType;
use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetName;
use PHPUnit\Framework\TestCase;

final class FacetDefinitionDTOTest extends TestCase
{
    public function testItCarriesEligibilityWithoutExecutionBehavior(): void
    {
        $definition = new FacetDefinitionDTO(
            new FacetCode('brand'),
            new FacetName('Brand'),
            FacetType::Term,
            filterable: true,
            searchable: false,
            position: 10,
        );

        self::assertSame('brand', $definition->identifier->toString());
        self::assertTrue($definition->filterable);
        self::assertFalse($definition->searchable);
        self::assertSame(10, $definition->position);
    }

    public function testItRejectsNegativePosition(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetDefinitionDTO(new FacetCode('brand'), new FacetName('Brand'), FacetType::Term, true, false, -1);
    }
}
