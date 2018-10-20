<?php

namespace Tests;

use TurtleCoin\TurtleService;

class TurtleServiceRequestTest extends TestCase
{
    public function testReset()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse(),
                $this->emptyResultResponse()
            ])
        ]);

        // Without view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset()->toJson()
        );

        // With view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset(static::VIEW_SECRET_KEY)->toJson()
        );
    }

    public function testSave()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse()
            ])
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->save()->toJson()
        );
    }

    public function testGetViewKey()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getViewKeyResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getViewKeyResponse()->getBody()->getContents(),
            $client->getViewKey()->toJson()
        );
    }

    public function testGetSpendKeys()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getSpendKeysResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getSpendKeysResponse()->getBody()->getContents(),
            $client->getSpendKeys(static::ADDRESS)->toJson()
        );
    }

    public function testGetStatus()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getStatusResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getStatusResponse()->getBody()->getContents(),
            $client->getStatus()->toJson()
        );
    }

    public function testGetAddresses()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getAddressesResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getAddressesResponse()->getBody()->getContents(),
            $client->getAddresses()->toJson()
        );
    }

    public function testCreateAddress()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->createAddressResponse()
            ])
        ]);

        $this->assertEquals(
            $this->createAddressResponse()->getBody()->getContents(),
            $client->createAddress()->toJson()
        );
    }

    public function testDeleteAddress()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse()
            ])
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->deleteAddress(static::ADDRESS)->toJson()
        );
    }

    public function testGetBalance()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getBalanceResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getBalanceResponse()->getBody()->getContents(),
            $client->getBalance(static::ADDRESS)->toJson()
        );
    }

    public function testGetBlockHashes()
    {
        $client = new TurtleService([
            'handler' => $this->mockHandler([
                $this->getBlockHashesResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getBlockHashesResponse()->getBody()->getContents(),
            $client->getBlockHashes(20, 3)->toJson()
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
}