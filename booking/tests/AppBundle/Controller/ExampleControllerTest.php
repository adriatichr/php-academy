<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExampleControllerTest extends WebTestCase
{
    public function testAccommodationDbalQueryBuilder()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/example/accommodation/1/dbal-query-builder');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testStoringAccommodationAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/example/accommodation/insert');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
