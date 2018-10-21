
# TurtleCoin RPC PHP

TurtleCoin RPC PHP is a PHP wrapper for the TurtleCoin JSON-RPC interfaces.

---

1) [Install TurtleCoin RPC PHP](#install-turtlecoin-rpc-php)
1) [Examples](#examples)
1) [Docs](#docs)
1) [License](#license)

---

## Install TurtleCoin RPC PHP

This package requires PHP >=7.1.3. Require this package with composer:

```
composer require turtlecoin/turtlecoin-rpc-php
```

## Examples

```php
use TurtleCoin\TurtleCoind;

$config = [
    'rpcHost' => 'http://127.0.0.1',
    'rpcPort' => 11898,
];

$turtlecoind = new TurtleCoind($config);
echo $turtlecoind->getBlockCount();

> {"id":2,"jsonrpc":"2.0","result":{"count":784547,"status":"OK"}}
``` 

```php
use TurtleCoin\TurtleService;

$config = [
    'rpcHost'     => 'http://127.0.0.1',
    'rpcPort'     => 8070,
    'rpcPassword' => 'test',
];

$turtleService = new TurtleService($config);
echo $turtleService->getBalance($walletAddress);

> {"id":0,"jsonrpc":"2.0","result":["availableBalance":100,"lockedAmount":50]}
``` 

Optionally, you may access details about the response:

```php
$response = $turtleService->getBalance($walletAddress);

// The result field from the RPC response
$response->result();

// RPC response as JSON string
$response->toJson();

// RPC response as an array
$response->toArray();

// Or other response details
$response->getStatusCode();
$response->getProtocolVersion();
$response->getHeaders();
$response->hasHeader($header);
$response->getHeader($header);
$response->getHeaderLine($header);
$response->getBody();
``` 

## Docs

Documentation of the TurtleCoin RPC API and more PHP examples for this package can be found at [api-docs.turtlecoin.lol](https://api-docs.turtlecoin.lol).

## License

TurtleCoin RPC PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
