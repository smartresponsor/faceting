<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\DTO\Localization;

use App\Faceting\DTO\Localization\FacetLocalizedLabelDTO;
use PHPUnit\Framework\TestCase;

final class FacetLocalizedLabelDTOTest extends TestCase
{
    public function testItNormalizesLocaleAndLabel(): void
    {
        $label = new FacetLocalizedLabelDTO('en_us', ' Brand ');

        self::assertSame('en-US', $label->locale);
        self::assertSame('Brand', $label->label);
    }

    public function testItSupportsLanguageOnlyLocale(): void
    {
        self::assertSame('uk', (new FacetLocalizedLabelDTO('UK', 'Бренд'))->locale);
    }

    public function testItRejectsBlankLabel(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetLocalizedLabelDTO('en-US', '   ');
    }

    public function testItRejectsOversizedLabel(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetLocalizedLabelDTO('en-US', str_repeat('x', 256));
    }

    public function testItNormalizesNumericRegion(): void
    {
        self::assertSame('es-419', (new FacetLocalizedLabelDTO('ES_419', 'Marca'))->locale);
    }

    public function testItRejectsInvalidLocale(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new FacetLocalizedLabelDTO('english-USA', 'Brand');
    }
}
