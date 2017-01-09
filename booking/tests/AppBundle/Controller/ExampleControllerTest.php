<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExampleControllerTest extends WebTestCase
{
    private static $accommodationRepository;

    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
        self::$accommodationRepository = static::$kernel->getContainer()->get('app.accommodation_repository');
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

    public function testTranslationInControllerAction()
    {
        $crawler = $this->client->request('GET', '/example/translation-in-controller');
        $content = (string)$this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Symfony is great', $content);
        $this->assertContains('Symfony je zakon', $content);
        $this->assertContains('Symfony is bloody brilliant, mate', $content);
        $this->assertContains('Symfony is awesome, man', $content);
        $this->assertContains('J\'aime Symfony', $content);
    }

    public function testTranslationWithPlaceholders()
    {
        $crawler = $this->client->request('GET', '/example/translation-with-placeholders');
        $content = (string)$this->client->getResponse()->getContent();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Hello Fabien', $content);
        $this->assertContains('Bonjour Fabien', $content);
        $this->assertContains('Zdravo Fabien', $content);
    }

    public static function tearDownAfterClass()
    {
        self::$accommodationRepository->deleteAllWithName('orm test');
    }
}
