<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /** @test */
    public function userDataActionShouldReturn404UnlessAjax()
    {
        $crawler = $this->client->request('GET', '/ajax/user-data');
        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
