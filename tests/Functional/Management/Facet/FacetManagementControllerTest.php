<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Functional\Management\Facet;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FacetManagementControllerTest extends WebTestCase
{
    public function testManagementPageRenders(): void
    {
        $client = static::createClient();
        $client->request('GET', '/facet/management/facets');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Faceting management');
        self::assertSelectorExists('form');
        self::assertSelectorExists('table');
    }
}
