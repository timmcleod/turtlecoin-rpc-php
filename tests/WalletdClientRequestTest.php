<?php

namespace Tests;

use TimMcLeod\TurtleCoin\Walletd;

class WalletdClientRequestTest extends TestCase
{
    public function testRpcMethods()
    {
        $methods = [
            "reset",
            "save",
            "getViewKey",
            "getSpendKeys",
            "getStatus",
            "getAddresses",
            "createAddress",
            "deleteAddress",
            "getBalance",
            "getBlockHashes",
            "getTransactionHashes",
            "getTransactions",
            "getUnconfirmedTransactionHashes",
            "getTransaction",
            "sendTransaction",
            "createDelayedTransaction",
            "getDelayedTransactionHashes",
            "deleteDelayedTransaction",
            "sendDelayedTransaction",
            "sendFusionTransaction",
            "estimateFusion"
        ];

        foreach ($methods as $method)
        {
            $client = new Walletd\Client(['handler' => $this->mockHandler()]);

            $this->assertEquals(
                $client->{$method}()->getBody()->getContents(),
                $this->dummyResponse()->getBody()->getContents()
            );
        }
    }

    public function testBadRpcMethod()
    {
        $client = new Walletd\Client(['handler' => $this->mockHandler()]);

        $this->expectException(\Exception::class);
        $client->badRpcMethod();
    }
}