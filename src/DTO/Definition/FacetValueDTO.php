<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Definition;

use App\Faceting\ValueObject\Definition\Facet\FacetCode;
use App\Faceting\ValueObject\Definition\Facet\FacetValueIdentifier;

/**
 * Neutral facet-value contract with an identifier that remains stable across reindexing.
 *
 * The optional external reference points at catalog-owned truth without copying taxonomy or
 * catalog persistence into Faceting.
 */
final readonly class FacetValueDTO
{
    public string $label;

    public ?string $externalReference;

    public function __construct(
        public FacetCode $facetIdentifier,
        public FacetValueIdentifier $identifier,
        string $label,
        public int $position = 0,
        ?string $externalReference = null,
    ) {
        $normalizedLabel = trim($label);
        if ('' === $normalizedLabel) {
            throw new \InvalidArgumentException('Facet value label must not be empty.');
        }

        if ($position < 0) {
            throw new \InvalidArgumentException('Facet value position must not be negative.');
        }

        $normalizedReference = null === $externalReference ? null : trim($externalReference);
        if ('' === $normalizedReference) {
            throw new \InvalidArgumentException('Facet value external reference must not be empty when provided.');
        }

        $this->label = $normalizedLabel;
        $this->externalReference = $normalizedReference;
    }
}
