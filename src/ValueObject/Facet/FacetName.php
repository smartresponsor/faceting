<?php

declare(strict_types=1);

namespace App\Faceting\ValueObject\Facet;

final readonly class FacetName
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = trim($value);

        if ('' === $normalized) {
            throw new \InvalidArgumentException('Facet name must not be empty.');
        }

        if (mb_strlen($normalized) > 255) {
            throw new \InvalidArgumentException('Facet name must not exceed 255 characters.');
        }

        $this->value = $normalized;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
