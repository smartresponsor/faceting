<?php

declare(strict_types=1);

namespace App\ValueObject\Facet;

use InvalidArgumentException;

final readonly class FacetCode
{
    public function __construct(private string $value)
    {
        $normalized = mb_strtolower(trim($value));

        if ('' === $normalized) {
            throw new InvalidArgumentException('Facet code must not be empty.');
        }

        if (!preg_match('/^[a-z0-9_\-]+$/', $normalized)) {
            throw new InvalidArgumentException('Facet code must use lowercase letters, numbers, dash, or underscore.');
        }

        $this->value = $normalized;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
