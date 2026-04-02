<?php

declare(strict_types=1);

namespace App\Tests\Functional\Management;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FacetManagementFormSubmitTest extends WebTestCase
{
    public function testPreviewFormSubmissionShowsMaterializedFacet(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/faceting/management/facets');

        $client->submit(
            $crawler->selectButton('Preview facet')->form([
                'facet_upsert[code]' => 'Campaign_Code',
                'facet_upsert[name]' => 'Campaign Facet',
                'facet_upsert[type]' => 'term',
                'facet_upsert[visible]' => '1',
            ])
        );

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('[data-testid="facet-preview-code"]', 'campaign_code');
        self::assertSelectorTextContains('.alert', 'Facet preview generated.');
    }
}
