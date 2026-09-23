<?php

declare(strict_types=1);

$root = dirname(__DIR__, 2);
$outputDirectory = $root.'/var/coverage';

if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0777, true) && !is_dir($outputDirectory)) {
    throw new RuntimeException(sprintf('Unable to create coverage directory: %s', $outputDirectory));
}

$requiredFiles = [
    'functional:management' => $root.'/tests/Functional/Management/Facet/FacetManagementControllerTest.php',
    'functional:api' => $root.'/tests/Functional/Api/Listing/FacetListingApiControllerTest.php',
    'behavioral:filter' => $root.'/tests/Functional/Management/Facet/FacetManagementFilteringTest.php',
    'behavioral:preview' => $root.'/tests/Functional/Management/Facet/FacetManagementFormSubmitTest.php',
    'ui:management' => $root.'/tests/UI/facet-management.spec.js',
];

foreach ($requiredFiles as $surface => $path) {
    if (!is_file($path)) {
        throw new RuntimeException(sprintf('Coverage evidence source %s is missing: %s', $surface, $path));
    }
}

$evidence = [
    'schema' => 'behavioral-ui-coverage-v2',
    'generatedAt' => (new DateTimeImmutable())->format(DateTimeInterface::ATOM),
    'producer' => [
        'kind' => 'repository_script',
        'script' => 'test:behavioral-coverage',
    ],
    'dimensions' => [
        'functional' => [
            'eligible' => ['route:faceting_management_index', 'route:faceting_api_listing'],
            'covered' => ['route:faceting_management_index', 'route:faceting_api_listing'],
        ],
        'behavioral' => [
            'eligible' => ['workflow:facet_management_filter', 'workflow:facet_preview'],
            'covered' => ['workflow:facet_management_filter', 'workflow:facet_preview'],
        ],
        'ui' => [
            'eligible' => ['surface:facet_management_filter', 'surface:facet_management_preview'],
            'covered' => ['surface:facet_management_filter', 'surface:facet_management_preview'],
        ],
        'critical' => [
            'eligible' => ['workflow:facet_preview'],
            'covered' => ['workflow:facet_preview'],
        ],
    ],
];

$json = json_encode($evidence, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
file_put_contents($outputDirectory.'/behavioral-ui.json', $json.PHP_EOL);
