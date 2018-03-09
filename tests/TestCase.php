<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use stdClass;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    const ADDRESS = 'TRTLxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    const VIEW_SECRET_KEY = '0000000000000000000000000000000000000000000000000000000000000000';
    const SPEND_PUBLIC_KEY = '0000000000000000000000000000000000000000000000000000000000000000';
    const SPEND_SECRET_KEY = '0000000000000000000000000000000000000000000000000000000000000000';
    const BLOCK_HASH = 'f0fe2fbf5816107ab6fc783cd6931ea310d984b8f341410bab945542690a4518';

    public function mockHandler($queue)
    {
        return HandlerStack::create(new MockHandler($queue));
    }

    public function emptyResultResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => new stdClass(),
        ]);

        return new Response(200, [], $json);
    }

    public function getViewKeyResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'viewSecretKey' => static::VIEW_SECRET_KEY
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getSpendKeysResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'spendPublicKey' => static::SPEND_PUBLIC_KEY,
                'spendSecretKey' => static::SPEND_SECRET_KEY,
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getStatusResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'blockCount'      => 249310,
                'knownBlockCount' => 249309,
                'lastBlockHash'   => '6d3925d415ed91c870a63320581bd3dc50f43c0466877d4ad790e531f2925815',
                'peerCount'       => 8,
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getAddressesResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'addresses' => [static::ADDRESS, static::ADDRESS],
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function createAddressResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'address' => static::ADDRESS
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getBalanceResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'availableBalance' => 100,
                'lockedAmount'     => 50
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getBlockHashesResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'blockHashes' => [
                    static::BLOCK_HASH,
                    static::BLOCK_HASH,
                    static::BLOCK_HASH,
                ]
            ],
        ]);

        return new Response(200, [], $json);
    }
}