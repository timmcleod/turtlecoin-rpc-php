<p align="center"><a href="https://turtlecoin.lol" target="_blank" style="max-width:50%;"><img src="https://user-images.githubusercontent.com/34389545/35821974-62e0e25c-0a70-11e8-87dd-2cfffeb6ed47.png"></a></p>

---

# TurtleCoin Walletd RPC PHP

TurtleCoin Walletd RPC PHP is a PHP wrapper for the TurtleCoin walletd JSON-RPC interface.

1) [Installation](#installation)
1) [Methods](#methods)
1) [Examples](#examples)
1) [Buy License](#buy-license)
1) [License](#actual-license)

## Installation

This package requires PHP >=7.1.3. Require this package with composer:

```
composer require timmcleod/turtlecoin-walletd-rpc-php
```

## Methods

| Method        | Params   | Description   |
| ------------- | ------------- | ------------- |
| reset | $viewSecretKey |	reset() method allows you to re-sync your wallet. |
| save |  |	save() method allows you to save your wallet by request. |
| getViewKey |  |	getViewKey() method returns address view key. |
| getSpendKeys | $address |	getSpendKeys() method returns address spend keys. |
| getStatus |  |	getStatus() method returns information about the current RPC Wallet state: block_count, known_block_count, last_block_hash and peer_count. |
| getAddresses |  |	getAddresses() method returns an array of your RPC Wallet's addresses. |
| createAddress | $secretSpendKey, $publicSpendKey |	createAddress() method creates an address. |
| deleteAddress | $address |	deleteAddress() method deletes a specified address. |
| getBalance | $address |	getBalance() method returns a balance for a specified address. If address is not specified, returns a cumulative balance of all RPC Wallet's addresses. |
| getBlockHashes | $firstBlockIndex, $blockCount |	getBlockHashes() method returns an array of block hashes for a specified block range. |
| getTransactionHashes | $blockCount, $firstBlockIndex, $blockHash, $addresses, $paymentId |	getTransactionHashes() method returns an array of block and transaction hashes. |
| getTransactions | $blockCount, $firstBlockIndex, $blockHash, $addresses, $paymentId |	getTransactions() method returns information about the transactions in specified block range or for specified addresses. |
| getUnconfirmedTransactionHashes | $addresses |	getUnconfirmedTransactionHashes() method returns information about the current unconfirmed transaction pool or for a specified addresses. |
| getTransaction | $transactionHash |	getTransaction() method returns information about the specified transaction. |
| sendTransaction | $anonymity, $transfers, $fee, $addresses, $unlockTime, $extra, $paymentId, $changeAddress |	sendTransaction() method creates and sends a transaction. |
| createDelayedTransaction | $anonymity, $transfers, $fee, $addresses, $unlockTime, $extra, $paymentId, $changeAddress |	createDelayedTransaction() method creates but not sends a transaction. |
| getDelayedTransactionHashes |  |	getDelayedTransactionHashes() method returns hashes of delayed transactions. |
| deleteDelayedTransaction | $transactionHash |	deleteDelayedTransaction() method deletes a specified delayed transaction. |
| sendDelayedTransaction | $transactionHash |	sendDelayedTransaction() method sends a specified delayed transaction. |
| sendFusionTransaction | $threshold, $anonymity, $addresses, $destinationAddress |	sendFusionTransaction() method creates and sends a fusion transaction. |
| estimateFusion | $threshold, $addresses |	estimateFusion() method allows to estimate a number of outputs that can be optimized with fusion transactions. |

## Examples

```php
use TimMcLeod\TurtleCoin\Walletd;

$walletd = new Walletd\Client();

$response = $walletd->getBalance($walletAddress);
```

```php
use TimMcLeod\TurtleCoin\Walletd;

$config = [
    'rpcHost'     => 'http://127.0.0.1',
    'rpcPort'     => 8070,
    'rpcPassword' => 'test',
];

$walletd = new Walletd\Client($config);

$json = $walletd->getBalance($walletAddress)->getBody()->getContents();

echo $json;

> {"id":0,"jsonrpc":"2.0","result":["availableBalance":100,"lockedAmount":50]}
```

## Buy License

Just kidding. This is free, open-source software. I would, however, appreciate any shells you want to send my way so I can buy TurtleCoin stickers.

```
TRTLv2z49dU7zGT4wuYBG2Sv4dkpWFJNb19PYUCeQ2Q89w6avCT92erRX7zye38CDpFA4XctvDoqC6gi5dCvEpT7gPijjPWnQFS
``` 

## Actual License

TurtleCoin Walletd RPC PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
