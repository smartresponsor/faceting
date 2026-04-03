<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FacetingListingApiControllerTest extends WebTestCase
{
    public function testListingEndpointReturnsFilteredJson(): void
    {
        $client = static::createClient();
        $client->request('GET', '/faceting/api/listing?type=range');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');

        $data = json_decode((string) $client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame(1, $data['total']);
        self::assertSame('price', $data['items'][0]['code']);
        self::assertSame('range', $data['items'][0]['type']);

        self::assertArrayHasKey('aggregations', $data);
        self::assertArrayHasKey('types', $data['aggregations']);
        self::assertArrayHasKey('visibility', $data['aggregations']);

        self::assertSame('range', $data['aggregations']['types'][0]['key']);
        self::assertSame(1, $data['aggregations']['types'][0]['count']);

        self::assertSame('visible', $data['aggregations']['visibility'][0]['key']);
        self::assertSame(1, $data['aggregations']['visibility'][0]['count']);
    }
}
