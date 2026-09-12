<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Architecture;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FacetConfigurationConventionTest extends TestCase
{
    #[DataProvider('activeMetadataProvider')]
    public function testActiveMetadataUsesCanonicalFacetConfigurationPrefix(string $relativePath): void
    {
        $projectRoot = dirname(__DIR__, 3);
        $path = $projectRoot.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        $contents = file_get_contents($path);

        self::assertNotFalse($contents, sprintf('Unable to read active metadata file "%s".', $relativePath));
        self::assertStringContainsString('facet_', $contents, sprintf('Expected canonical facet_ convention in "%s".', $relativePath));
        self::assertStringNotContainsString(
            'faceting_',
            $contents,
            sprintf('Active metadata file "%s" still teaches the retired faceting_ config convention.', $relativePath),
        );
    }

    /**
     * Lists active repository metadata that encodes the component-owned YAML filename convention.
     *
     * @return iterable<string, array{string}>
     */
    public static function activeMetadataProvider(): iterable
    {
        yield 'readme' => ['README.md'];
        yield 'architecture manifesto' => ['ARCHITECTURE_MANIFESTO.md'];
        yield 'acceptance gates' => ['manifest/faceting.acceptance-gates.yaml'];
        yield 'canon manifest' => ['manifest/faceting.canon.yaml'];
        yield 'examples manifest' => ['manifest/faceting.non_normative.examples.yaml'];
    }
}
