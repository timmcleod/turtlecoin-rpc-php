<?php

namespace Tests;

use TurtleCoin\TurtleService;

class ConfigureTurtleServiceTest extends TestCase
{
    public function testConfigureDefaultValues()
    {
        $turtleService = new TurtleService();
        $turtleService->configure([]);
        $this->assertEquals([
            'rpcHost'      => 'http://127.0.0.1',
            'rpcPort'      => 8070,
            'rpcPassword'  => 'test',
            'rpcBaseRoute' => '/json_rpc',
        ], $turtleService->config());
    }

    public function testConfigureAllValues()
    {
        $turtleService = new TurtleService();
        $turtleService->configure([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ]);

        $this->assertEquals([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ], $turtleService->config());
    }

    public function testConfigureViaConstructor()
    {
        $turtleService = new TurtleService([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ]);

        $this->assertEquals([
            'rpcHost'      => 'https://192.168.10.10',
            'rpcPort'      => 8080,
            'rpcPassword'  => 'testing',
            'rpcBaseRoute' => '/api/v1',
        ], $turtleService->config());
    }

    public function testConfigureDoesntOverwriteOtherVariables()
    {
        $turtleService = new TurtleService();
        $turtleService->configure([
            'client' => 'should not be able to set this value',
        ]);

        $this->assertNotEquals($turtleService->client(), 'should not be able to set this value');
    }
}