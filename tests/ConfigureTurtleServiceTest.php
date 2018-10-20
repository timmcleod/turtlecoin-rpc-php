<?php

namespace Tests;

use TurtleCoin\TurtleService;

class ConfigureTurtleServiceTest extends TestCase
{
    public function testConfigureDefaultValues()
    {
        $walletd = new TurtleService();
        $walletd->configure([]);
        $this->assertEquals([
            'rpcHost'     => 'http://127.0.0.1',
            'rpcPort'     => 8070,
            'rpcPassword' => 'test',
        ], $walletd->config());
    }

    public function testConfigureAllValues()
    {
        $walletd = new TurtleService();
        $walletd->configure([
            'rpcHost'     => 'https://192.168.10.10',
            'rpcPort'     => 8080,
            'rpcPassword' => 'testing',
        ]);

        $this->assertEquals([
            'rpcHost'     => 'https://192.168.10.10',
            'rpcPort'     => 8080,
            'rpcPassword' => 'testing',
        ], $walletd->config());
    }

    public function testConfigureViaConstructor()
    {
        $walletd = new TurtleService([
            'rpcHost'     => 'https://192.168.10.10',
            'rpcPort'     => 8080,
            'rpcPassword' => 'testing',
        ]);

        $this->assertEquals([
            'rpcHost'     => 'https://192.168.10.10',
            'rpcPort'     => 8080,
            'rpcPassword' => 'testing',
        ], $walletd->config());
    }

    public function testConfigureDoesntOverwriteOtherVariables()
    {
        $walletd = new TurtleService();
        $walletd->configure([
            'client' => 'should not be able to set this value',
        ]);

        $this->assertNotEquals($walletd->client(), 'should not be able to set this value');
    }
}