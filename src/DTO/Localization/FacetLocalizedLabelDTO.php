<?php

declare(strict_types=1);

namespace App\Faceting\DTO\Localization;

/**
 * Carries one normalized locale-specific label without assigning rendering responsibility to Faceting.
 */
final readonly class FacetLocalizedLabelDTO
{
    public string $locale;

    public string $label;

    public function __construct(string $locale, string $label)
    {
        $normalizedLocale = str_replace('_', '-', trim($locale));
        if (!preg_match('/^[a-zA-Z]{2,3}(?:-[a-zA-Z]{2}|-[0-9]{3})?$/', $normalizedLocale)) {
            throw new \InvalidArgumentException('Facet locale must be a language code with an optional region.');
        }

        $parts = explode('-', $normalizedLocale);
        $this->locale = isset($parts[1])
            ? strtolower($parts[0]).'-'.(ctype_digit($parts[1]) ? $parts[1] : strtoupper($parts[1]))
            : strtolower($parts[0]);

        $normalizedLabel = trim($label);
        if ('' === $normalizedLabel) {
            throw new \InvalidArgumentException('Facet localized label must not be empty.');
        }

        if (mb_strlen($normalizedLabel) > 255) {
            throw new \InvalidArgumentException('Facet localized label must not exceed 255 characters.');
        }

        $this->label = $normalizedLabel;
    }
}
