<?php

declare(strict_types=1);

namespace App\Tests\Functional\Management;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FacetManagementFilteringTest extends WebTestCase
{
    public function testManagementPageUsesEngineFiltering(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/faceting/management/facets?type=range');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('[data-testid="facet-total"]', '1');
        self::assertStringContainsString('price', strtolower($crawler->filter('table')->text()));
        self::assertStringNotContainsString('brand', strtolower($crawler->filter('table')->text()));
    }
}
