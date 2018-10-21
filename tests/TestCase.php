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
    const BLOCK_COUNT = 249310;
    const KNOWN_BLOCK_COUNT = 249320;
    const HEIGHT = 249311;
    const NETWORK_HEIGHT = 249321;
    const PEER_COUNT = 8;
    const AVAILABLE_BALANCE = 100;
    const LOCKED_AMOUNT = 50;

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
                'viewSecretKey' => static::VIEW_SECRET_KEY,
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
                'blockCount'      => static::BLOCK_COUNT,
                'knownBlockCount' => static::KNOWN_BLOCK_COUNT,
                'lastBlockHash'   => static::BLOCK_HASH,
                'peerCount'       => static::PEER_COUNT,
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
                'address' => static::ADDRESS,
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
                'availableBalance' => static::AVAILABLE_BALANCE,
                'lockedAmount'     => static::LOCKED_AMOUNT,
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
                ],
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getBlockCountResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'count'  => static::BLOCK_COUNT,
                'status' => 'OK',
            ],
        ]);

        return new Response(200, [], $json);
    }

    public function getHeightResponse()
    {
        $json = json_encode([
            'id'      => 0,
            'jsonrpc' => '2.0',
            'result'  => [
                'height'         => static::HEIGHT,
                'network_height' => static::NETWORK_HEIGHT,
                'status'         => 'OK',
            ],
        ]);

        return new Response(200, [], $json);
    }
}