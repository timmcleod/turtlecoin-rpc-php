<?php

namespace Tests;

use TurtleCoin\Walletd;

class ConfigureWalletdClientTest extends TestCase
{
    public function testConfigureDefaultValues()
    {
        $walletd = new Walletd\Client();
        $walletd->configure([]);
        $this->assertEquals([
            'rpcHost'     => 'http://127.0.0.1',
            'rpcPort'     => 8070,
            'rpcPassword' => 'test',
        ], $walletd->config());
    }

    public function testConfigureAllValues()
    {
        $walletd = new Walletd\Client();
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
        $walletd = new Walletd\Client([
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
        $walletd = new Walletd\Client();
        $walletd->configure([
            'client' => 'should not be able to set this value',
        ]);

        $this->assertNotEquals($walletd->client(), 'should not be able to set this value');
    }
}