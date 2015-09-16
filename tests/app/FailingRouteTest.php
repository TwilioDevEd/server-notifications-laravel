<?php

class FailingRouteTest extends TestCase
{
    public function testSendNotificationMessage()
    {
        $response = $this->call('GET', '/');
        error_log(var_dump($response->getContent()));
    }
}
