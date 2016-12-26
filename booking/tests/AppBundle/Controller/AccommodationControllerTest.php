<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccommodationControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @testWith [1]
     *           [2]
     */
    public function accommodationAction($accommodationId)
    {
        $crawler = $this->client->request('GET', sprintf('/accommodation/%s', $accommodationId));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @testWith [1]
     *           [2]
     */
    public function accommodationImageAction($accommodationId)
    {
        $crawler = $this->client->request('GET', sprintf('/accommodation/image/main/%s', $accommodationId));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function accommodationListAction()
    {
        $crawler = $this->client->request('GET', '/accommodation');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
