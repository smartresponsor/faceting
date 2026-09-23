<?php

declare(strict_types=1);

$publicDirectory = dirname(__DIR__, 2).'/public';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

if (is_string($requestPath)) {
    $candidate = realpath($publicDirectory.$requestPath);
    $publicRoot = realpath($publicDirectory);

    if (false !== $candidate && false !== $publicRoot && str_starts_with($candidate, $publicRoot) && is_file($candidate)) {
        return false;
    }
}

foreach (['APP_ENV', 'APP_DEBUG', 'DATABASE_URL'] as $name) {
    $value = getenv($name);
    if (false !== $value) {
        $_SERVER[$name] = $_ENV[$name] = $value;
    }
}

require $publicDirectory.'/index.php';
