<?php

namespace SlimishTest;

use Slimish\TestCase;

class ErrorTest extends TestCase
{
    public function testError()
    {
        $this->client->get('/nonsense');
        $this->assertEquals(404, $this->client->response->status());
    }
}
