<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use stdClass;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function mockHandler($queue = [])
    {
        if (empty($queue)) $queue = [$this->dummyResponse()];

        return HandlerStack::create(new MockHandler($queue));
    }

    public function dummyResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => new stdClass(),
        ]);

        return new Response(200, [], $json);
    }
}