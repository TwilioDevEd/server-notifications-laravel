<?php

class FailingRouteTest extends TestCase
{
    public function testSendNotificationMessage()
    {
        $response = $this->call('GET', '/error');
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testCorrectRoute()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
