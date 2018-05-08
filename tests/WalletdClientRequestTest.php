<?php

namespace Tests;

use TurtleCoin\Walletd;

class WalletdClientRequestTest extends TestCase
{
    public function testReset()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse(),
                $this->emptyResultResponse()
            ])
        ]);

        // Without view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset()->getBody()->getContents()
        );

        // With view key
        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->reset(static::VIEW_SECRET_KEY)->getBody()->getContents()
        );
    }

    public function testSave()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse()
            ])
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->save()->getBody()->getContents()
        );
    }

    public function testGetViewKey()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getViewKeyResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getViewKeyResponse()->getBody()->getContents(),
            $client->getViewKey()->getBody()->getContents()
        );
    }

    public function testGetSpendKeys()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getSpendKeysResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getSpendKeysResponse()->getBody()->getContents(),
            $client->getSpendKeys(static::ADDRESS)->getBody()->getContents()
        );
    }

    public function testGetStatus()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getStatusResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getStatusResponse()->getBody()->getContents(),
            $client->getStatus()->getBody()->getContents()
        );
    }

    public function testGetAddresses()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getAddressesResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getAddressesResponse()->getBody()->getContents(),
            $client->getAddresses()->getBody()->getContents()
        );
    }

    public function testCreateAddress()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->createAddressResponse()
            ])
        ]);

        $this->assertEquals(
            $this->createAddressResponse()->getBody()->getContents(),
            $client->createAddress()->getBody()->getContents()
        );
    }

    public function testDeleteAddress()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->emptyResultResponse()
            ])
        ]);

        $this->assertEquals(
            $this->emptyResultResponse()->getBody()->getContents(),
            $client->deleteAddress(static::ADDRESS)->getBody()->getContents()
        );
    }

    public function testGetBalance()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getBalanceResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getBalanceResponse()->getBody()->getContents(),
            $client->getBalance(static::ADDRESS)->getBody()->getContents()
        );
    }

    public function testGetBlockHashes()
    {
        $client = new Walletd\Client([
            'handler' => $this->mockHandler([
                $this->getBlockHashesResponse()
            ])
        ]);

        $this->assertEquals(
            $this->getBlockHashesResponse()->getBody()->getContents(),
            $client->getBlockHashes(20, 3)->getBody()->getContents()
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