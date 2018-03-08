<?php

namespace TimMcLeod\TurtleCoin\Walletd;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use PHPUnit\Runner\Exception;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /** @var ClientInterface */
    protected $client = null;

    /** @var int */
    protected $rpcId = 0;

    /** @var string */
    protected $rpcHost = 'http://127.0.0.1';

    /** @var int */
    protected $rpcPort = 8070;

    /** @var string */
    protected $rpcPassword = 'test';

    /** @var array */
    public static $rpcMethods = [
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

    /**
     * Wrapper for TurtleCoin walletd JSON-RPC interface.
     *
     * @param array $config Configuration options
     */
    public function __construct(array $config = [])
    {
        $this->configure($config);

        $this->client = new GuzzleClient(empty($config['handler']) ? [] : ['handler' => $config['handler']]);
    }

    /**
     * Applies configuration options.
     *
     * @param array $config Configuration options:
     *                      rpcHost: The hostname of the walletd daemon (must include http://)
     *                      rpcPort: The port number the walletd daemon is listening on
     *                      rpcPassword: The password for walletd's JSON-RPC interface
     */
    public function configure(array $config = []):void
    {
        $config = array_intersect_key($config, array_flip(['rpcHost', 'rpcPort', 'rpcPassword']));

        foreach ($config as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

    /**
     * Returns array of configuration options.
     *
     * @return array
     */
    public function config():array
    {
        return [
            'rpcHost'     => $this->rpcHost,
            'rpcPort'     => $this->rpcPort,
            'rpcPassword' => $this->rpcPassword,
        ];
    }

    /**
     * @param string $method
     * @param array  $params
     * @return ResponseInterface
     */
    public function request(string $method, array $params = []):ResponseInterface
    {
        $options = [
            'jsonrpc' => '2.0',
            'id'      => $this->rpcId,
            'method'  => $method,
        ];

        if (!empty($params)) $options['params'] = $params;

        if (!empty($this->rpcPassword)) $options['password'] = $this->rpcPassword;

        $response = $this->client->post($this->uri(), [RequestOptions::JSON => $options]);

        $this->rpcId++;

        return $response;
    }

    /**
     * Returns the walletd endpoint URI.
     *
     * @return string
     */
    public function uri():string
    {
        return "$this->rpcHost:$this->rpcPort/json_rpc";
    }

    /**
     * @return ClientInterface
     */
    public function client():ClientInterface
    {
        return $this->client;
    }

    /**
     * Makes a call to one of
     *
     * @param $method
     * @param $args
     * @return ResponseInterface
     */
    public function __call($method, $args)
    {
        if (!in_array($method, static::$rpcMethods)) throw new Exception("Invalid Method: [$method]");

        return $this->request($method, empty($args) ? [] : $args);
    }

    /**
     * Re-syncs the wallet.
     *
     * If the $viewSecretKey parameter is not specified, the reset() method resets the wallet and
     * re-syncs it. If the $viewSecretKey argument is specified, reset() method substitutes
     * the existing wallet with a new one with a specified $viewSecretKey and creates an
     * address for it.
     *
     * @param string|null $viewSecretKey Private view key. Optional.
     */
    public function reset($viewSecretKey = null) { }

    /**
     * Saves the wallet.
     */
    public function save() { }

    /**
     * Returns the view key.
     */
    public function getViewKey() { }

    /**
     * Returns the spend keys.
     *
     * @param string $address Valid and existing in this container address. Required.
     */
    public function getSpendKeys($address) { }

    /**
     * Returns information about the current RPC Wallet state:
     * block_count, known_block_count, last_block_hash and peer_count.
     */
    public function getStatus() { }

    /**
     * Returns an array of your RPC Wallet's addresses.
     */
    public function getAddresses() { }

    /**
     * Creates an additional address in your wallet.
     *
     * @param string|null $secretSpendKey Private spend key. If secretSpendKey was specified,
     *                                    RPC Wallet creates spend address. Optional.
     * @param string|null $publicSpendKey Public spend key. If publicSpendKey was specified,
     *                                    RPC Wallet creates view address. Optional.
     */
    public function createAddress($secretSpendKey = null, $publicSpendKey = null) { }

    /**
     * Deletes a specified address.
     *
     * @param string $address An address to be deleted. Required.
     */
    public function deleteAddress($address) { }

    /**
     * Method returns a balance for a specified address.
     *
     * @param string|null $address Valid and existing address in this wallet. Optional.
     */
    public function getBalance($address = null) { }

    /**
     * Returns an array of block hashes for a specified block range.
     *
     * @param integer $firstBlockIndex Starting height. Required.
     * @param integer $blockCount      Number of blocks to process. Required.
     */
    public function getBlockHashes($firstBlockIndex, $blockCount) { }

    /**
     * Returns an array of block and transaction hashes. Transaction consists of transfers.
     * Transfer is an amount-address pair. There could be several transfers in a single transaction.
     *
     * @param integer      $blockCount      Number of blocks to return transaction hashes from. Required.
     * @param integer|null $firstBlockIndex Starting height. Only allowed without $blockHash.
     * @param string|null  $blockHash       Hash of the starting block. Only allowed without $firstBlockIndex.
     * @param array|null   $addresses       Array of strings, where each string is an address. Optional.
     * @param string|null  $paymentId       Valid payment_id. Optional.
     */
    public function getTransactionHashes(
        $blockCount,
        $firstBlockIndex = null,
        $blockHash = null,
        $addresses = null,
        $paymentId = null
    ) {
    }

    /**
     * Returns an array of block and transaction hashes. Transaction consists of transfers.
     * Transfer is an amount-address pair. There could be several transfers in a single transaction.
     *
     * @param integer      $blockCount      Number of blocks to return transaction hashes from. Required.
     * @param integer|null $firstBlockIndex Starting height. Only allowed without $blockHash.
     * @param string|null  $blockHash       Hash of the starting block. Only allowed without $firstBlockIndex.
     * @param array|null   $addresses       Array of strings, where each string is an address. Optional.
     * @param string|null  $paymentId       Valid payment_id. Optional.
     */
    public function getTransactions(
        $blockCount,
        $firstBlockIndex = null,
        $blockHash = null,
        $addresses = null,
        $paymentId = null
    ) {
    }

    /**
     * Returns information about the current unconfirmed transaction pool or for a specified addresses.
     * Transaction consists of transfers. Transfer is an amount-address pair. There could be several
     * transfers in a single transaction.
     *
     * @param array|null $addresses Array of strings, where each string is a valid address. Optional.
     */
    public function getUnconfirmedTransactionHashes($addresses = null) { }

    /**
     * Returns information about a particular transaction. Transaction consists of transfers.
     * Transfer is an amount-address pair. There could be several transfers in a single transaction.
     *
     * @param string $transactionHash Hash of the requested transaction. Required.
     */
    public function getTransaction($transactionHash) { }

    /**
     * @param integer $anonymity Privacy level (a discrete number from 1 to infinity). 6+ recommended. Required.
     * @param array   $transfers Array that contains: address as string, amount as integer. Required.
     * @param         $fee Transaction fee.
     * @param null    $addresses
     * @param null    $unlockTime
     * @param null    $extra
     * @param null    $paymentId
     * @param null    $changeAddress
     */
    public function sendTransaction(
        $anonymity,
        $transfers,
        $fee,
        $addresses = null,
        $unlockTime = null,
        $extra = null,
        $paymentId = null,
        $changeAddress = null
    ) {
    }

    public function createDelayedTransaction() { }

    public function getDelayedTransactionHashes() { }

    public function deleteDelayedTransaction() { }

    public function sendDelayedTransaction() { }

    public function sendFusionTransaction() { }

    public function estimateFusion() { }
}