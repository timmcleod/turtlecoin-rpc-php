<?php

namespace Tests;

use TurtleCoin\TurtleCoind;
use TurtleCoin\TurtleService;

class TurtleServiceRequestTest extends TestCase
{
    // -------------------------------------------
    // TurtleService
    // -------------------------------------------

    public function testReset()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse(),
                $this->emptyResultResponse(),
                $this->emptyResultResponse(),
                $this->emptyResultResponse(),
            ]),
        ]);

        // Without view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset()
        );

        $this->assertEquals([], $client->reset()->result());

        // With view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset(static::VIEW_SECRET_KEY)
        );

        $this->assertEquals([], $client->reset(static::VIEW_SECRET_KEY)->result());
    }

    public function testSave()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse(),
                $this->emptyResultResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->save()
        );

        $this->assertEquals([], $client->save()->result());
    }

    public function testGetViewKey()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getViewKeyResponse(),
                $this->getViewKeyResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getViewKeyResponse()->getBody()->getContents(),
            $client->getViewKey()
        );

        $this->assertEquals(
            ['viewSecretKey' => TestCase::VIEW_SECRET_KEY],
            $client->getViewKey()->result()
        );
    }

    public function testGetSpendKeys()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getSpendKeysResponse(),
                $this->getSpendKeysResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getSpendKeysResponse()->getBody()->getContents(),
            $client->getSpendKeys(static::ADDRESS)
        );

        $this->assertEquals(
            [
                'spendPublicKey' => TestCase::SPEND_PUBLIC_KEY,
                'spendSecretKey' => TestCase::SPEND_SECRET_KEY,
            ],
            $client->getSpendKeys(static::ADDRESS)->result()
        );
    }

    public function testGetStatus()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getStatusResponse(),
                $this->getStatusResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getStatusResponse()->getBody()->getContents(),
            $client->getStatus()
        );

        $this->assertEquals(
            [
                'blockCount'      => static::BLOCK_COUNT,
                'knownBlockCount' => static::KNOWN_BLOCK_COUNT,
                'lastBlockHash'   => static::BLOCK_HASH,
                'peerCount'       => static::PEER_COUNT,
            ],
            $client->getStatus()->result()
        );
    }

    public function testGetAddresses()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getAddressesResponse(),
                $this->getAddressesResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getAddressesResponse()->getBody()->getContents(),
            $client->getAddresses()
        );

        $this->assertEquals(
            [
                'addresses' => [
                    TestCase::ADDRESS,
                    TestCase::ADDRESS,
                ],
            ],
            $client->getAddresses()->result()
        );
    }

    public function testCreateAddress()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->createAddressResponse(),
                $this->createAddressResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->createAddressResponse()->getBody()->getContents(),
            $client->createAddress()
        );

        $this->assertEquals(
            ['address' => TestCase::ADDRESS],
            $client->createAddress()->result()
        );
    }

    public function testDeleteAddress()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse(),
                $this->emptyResultResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->deleteAddress(static::ADDRESS)
        );

        $this->assertEquals([], $client->deleteAddress(static::ADDRESS)->result());
    }

    public function testGetBalance()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getBalanceResponse(),
                $this->getBalanceResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getBalanceResponse()->getBody()->getContents(),
            $client->getBalance(static::ADDRESS)
        );

        $this->assertEquals(
            [
                'availableBalance' => TestCase::AVAILABLE_BALANCE,
                'lockedAmount'     => TestCase::LOCKED_AMOUNT,
            ],
            $client->getBalance(static::ADDRESS)->result()
        );
    }

    public function testGetBlockHashes()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getBlockHashesResponse(),
                $this->getBlockHashesResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getBlockHashesResponse()->getBody()->getContents(),
            $client->getBlockHashes(20, 3)
        );

        $this->assertEquals(
            [
                'blockHashes' => [
                    TestCase::BLOCK_HASH,
                    TestCase::BLOCK_HASH,
                    TestCase::BLOCK_HASH,
                ]
            ],
            $client->getBlockHashes(20, 3)->result()
        );
    }

    // TODO: test getTransactionHashes()
    // TODO: test getTransactions()
    // TODO: test getUnconfirmedTransactionHashes()
    // TODO: test getTransaction()
    // TODO: test sendTransaction()
    // TODO: test createDelayedTransaction()
    // TODO: test getDelayedTransactionHashes()
    // TODO: test deleteDelayedTransaction()
    // TODO: test sendDelayedTransaction()
    // TODO: test sendFusionTransaction()
    // TODO: test estimateFusion()
    // TODO: test getMnemonicSeed()

    // -------------------------------------------
    // TurtleCoind
    // -------------------------------------------

    public function testGetBlockCount()
    {
        $client = new TurtleCoind([
            'handler' => $this->mockHandler([
                $this->getBlockCountResponse(),
                $this->getBlockCountResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getBlockCountResponse()->getBody()->getContents(),
            $client->getBlockCount()
        );

        $this->assertEquals(
            [
                'count'  => TestCase::BLOCK_COUNT,
                'status' => 'OK',
            ],
            $client->getBlockCount()->result()
        );
    }

    // ...

    public function testGetHeight()
    {
        $client = new TurtleCoind([
            'handler' => $this->mockHandler([
                $this->getHeightResponse(),
                $this->getHeightResponse(),
            ]),
        ]);

        $this->assertEquals(
            $this->getHeightResponse()->getBody()->getContents(),
            $client->getHeight()
        );

        $this->assertEquals(
            [
                'height'         => TestCase::HEIGHT,
                'network_height' => TestCase::NETWORK_HEIGHT,
                'status'         => 'OK',
            ],
            $client->getHeight()->result()
        );
    }
}