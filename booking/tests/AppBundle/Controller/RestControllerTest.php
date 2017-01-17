<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Accommodation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestControllerTest extends WebTestCase
{
    private static $accommodationRepository;

    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
        self::$accommodationRepository = static::$kernel->getContainer()->get('app.accommodation_repository');
    }

    /** @test */
    public function getAccommodation()
    {
        $crawler = $this->client->request('GET', '/rest/accommodations/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContentTypeIsJson();
        $content = json_decode((string)$this->client->getResponse()->getContent());
        $this->assertEquals('Split Luxury Rentals', $content->name);
    }

    /** @test */
    public function postMethodNotAllowedForAccommodation()
    {
        $crawler = $this->client->request('POST', '/rest/accommodations/1');
        $this->assertEquals(405, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function getAccommodationNotFound()
    {
        $crawler = $this->client->request('GET', '/rest/accommodations/-500');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $this->assertContentTypeIsJson();
        $content = json_decode((string)$this->client->getResponse()->getContent());
        $this->assertEquals('Accommodation with id -500 not found.', $content->error);
    }

    /** @test */
    public function deleteAccommodation()
    {
        $accommodationId = $this->createTestingAccommodation();

        $crawler = $this->client->request('DELETE', '/rest/accommodations/' . $accommodationId);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContentTypeIsJson();
        $content = json_decode((string)$this->client->getResponse()->getContent());
        $this->assertEquals(sprintf('Accommodation with id %d deleted', $accommodationId), $content->success);
        $this->assertNull(self::$accommodationRepository->findOneById($accommodationId));
    }

    /** @test */
    public function deleteAccommodation404()
    {
        $crawler = $this->client->request('DELETE', '/rest/accommodations/-500');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $this->assertContentTypeIsJson();
        $content = json_decode((string)$this->client->getResponse()->getContent());
        $this->assertEquals('Accommodation with id -500 not found.', $content->error);
    }

    private function createTestingAccommodation() : int
    {
        $placeRepository = static::$kernel->getContainer()->get('app.place_repository');

        $accommodation = new Accommodation();
        $accommodation->setName('orm test');
        $accommodation->setPricePerDay(123456);
        $accommodation->setPlace($placeRepository->findOneById(1));

        $entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $entityManager->persist($accommodation);
        $entityManager->flush();

        return $accommodation->getId();
    }

    public static function tearDownAfterClass()
    {
        self::$accommodationRepository->deleteAllWithName('orm test');
    }

    private function assertContentTypeIsJson()
    {
        $this->assertEquals('application/json', $this->client->getResponse()->headers->get('Content-Type'));
    }
}
