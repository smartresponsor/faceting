<?php

declare(strict_types=1);

namespace App\Faceting\ValueObject\Definition\Facet;

/**
 * Stable application-level identifier for a facet value across indexing and presentation rebuilds.
 */
final readonly class FacetValueIdentifier
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = mb_strtolower(trim($value));

        if ('' === $normalized) {
            throw new \InvalidArgumentException('Facet value identifier must not be empty.');
        }

        if (mb_strlen($normalized) > 128) {
            throw new \InvalidArgumentException('Facet value identifier must not exceed 128 characters.');
        }

        if (!preg_match('/^[a-z0-9][a-z0-9_.:\-]*$/', $normalized)) {
            throw new \InvalidArgumentException('Facet value identifier must use lowercase letters, numbers, dot, colon, dash, or underscore.');
        }

        $this->value = $normalized;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
