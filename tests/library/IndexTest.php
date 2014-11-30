<?php

namespace SlimishTest;

use Slimish\TestCase;

class IndexTest extends TestCase
{
    public function testHome()
    {
        $this->client->get('/');
        $this->assertEquals(200, $this->client->response->status());
        $this->assertContains('Welcome', $this->client->response->body());
    }
}
