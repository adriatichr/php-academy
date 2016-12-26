<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExampleControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testAccommodationDbalQueryBuilder()
    {
        $crawler = $this->client->request('GET', '/example/accommodation/1/dbal-query-builder');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testStoringAccommodationAction()
    {
        $crawler = $this->client->request('GET', '/example/accommodation/insert');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testExpirationCacheAction()
    {
        $crawler = $this->client->request('GET', '/example/cache/expiration/super-slow-page');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testETagValidationCacheAction()
    {
        $crawler = $this->client->request('GET', '/example/cache/validation/etag');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLastModifiedValidationCacheAction()
    {
        $crawler = $this->client->request('GET', '/example/cache/validation/last-modified/accommodation/1');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
