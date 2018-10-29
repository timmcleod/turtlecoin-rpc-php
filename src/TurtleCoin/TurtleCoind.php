<?php

namespace TurtleCoin;

use TurtleCoin\Http\JsonResponse;
use TurtleCoin\Http\RpcClient;

/**
 * Wrapper for TurtleCoin's TurtleCoind JSON-RPC interface.
 * @package TurtleCoin
 */
class TurtleCoind extends RpcClient
{
    /** @var int */
    protected $rpcPort = 11898;

    /** @var string */
    protected $rpcBaseRoute = '/json_rpc';

    /**
     * Returns the current chain height.
     *
     * @return JsonResponse
     */
    public function getBlockCount():JsonResponse
    {
        return $this->rpcPost('getblockcount', []);
    }

    /**
     * Returns block hash for a given height off by one (hash of previous block).
     *
     * @param string $height The height of the block whose previous hash is to be retrieved. Required.
     * @return JsonResponse
     */
    public function getBlockHash(string $height):JsonResponse
    {
        $params = [$height];

        return $this->rpcPost('on_getblockhash', $params);
    }

    /**
     * Returns block template with an empty "hole" for nonce.
     *
     * @param int    $reserveSize Size of the reserve to be specified. Required.
     * @param string $address     Valid TurtleCoin wallet address. Required.
     * @return JsonResponse
     */
    public function getBlockTemplate(int $reserveSize, string $address):JsonResponse
    {
        $params = [
            'reserve_size'   => $reserveSize,
            'wallet_address' => $address,
        ];

        return $this->rpcPost('getblocktemplate', $params);
    }

    /**
     * Submits mined block.
     *
     * @param string $blockBlob Block blob of the mined block.
     * @return JsonResponse
     */
    public function submitBlock(string $blockBlob):JsonResponse
    {
        $params = [$blockBlob];

        return $this->rpcPost('submitblock', $params);
    }

    /**
     * Retrieve header of the last block.
     *
     * @return JsonResponse
     */
    public function getLastBlockHeader():JsonResponse
    {
        return $this->rpcPost('getlastblockheader', []);
    }

    /**
     * Returns block header of the given block hash.
     *
     * @param string $hash Hash of the block.
     * @return JsonResponse
     */
    public function getBlockHeaderByHash(string $hash):JsonResponse
    {
        $params = [
            'hash' => $hash,
        ];

        return $this->rpcPost('getblockheaderbyhash', $params);
    }

    /**
     * Returns block header of the given block height.
     *
     * @param int $height Height of the block.
     * @return JsonResponse
     */
    public function getBlockHeaderByHeight(int $height):JsonResponse
    {
        $params = [
            'height' => $height,
        ];

        return $this->rpcPost('getblockheaderbyheight', $params);
    }

    /**
     * Returns unique currency identifier.
     *
     * @return JsonResponse
     */
    public function getCurrencyId():JsonResponse
    {
        return $this->rpcPost('getcurrencyid', []);
    }

    /**
     * Returns information on the last 30 blocks from the given height (inclusive).
     *
     * @param int $height Height of the last block to be included in the result.
     * @return JsonResponse
     */
    public function getBlocks(int $height):JsonResponse
    {
        $params = [
            'height' => $height,
        ];

        return $this->rpcPost('f_blocks_list_json', $params);
    }

    /**
     * Returns information on a single block of the given hash.
     *
     * @param string $hash Hash of the block.
     * @return JsonResponse
     */
    public function getBlock(string $hash):JsonResponse
    {
        $params = [
            'hash' => $hash,
        ];

        return $this->rpcPost('f_block_json', $params);
    }

    /**
     * Returns information on the transaction with the given hash.
     *
     * @param string $hash
     * @return JsonResponse
     */
    public function getTransaction(string $hash):JsonResponse
    {
        $params = [
            'hash' => $hash,
        ];

        return $this->rpcPost('f_transaction_json', $params);
    }

    /**
     * Returns the list of transaction hashes present in the transaction pool.
     *
     * @return JsonResponse
     */
    public function getTransactionPool():JsonResponse
    {
        return $this->rpcPost('f_on_transactions_pool_json', []);
    }

    /**
     * Returns the current height of the daemon and the network.
     *
     * @return JsonResponse
     */
    public function getHeight():JsonResponse
    {
        return $this->rpcGet('height');
    }

    /**
     * Returns information related to the network and daemon connection.
     *
     * @return JsonResponse
     */
    public function getInfo():JsonResponse
    {
        return $this->rpcGet('info');
    }

    /**
     * Returns list of missed transactions.
     *
     * @return JsonResponse
     */
    public function getTransactions():JsonResponse
    {
        return $this->rpcGet('gettransactions');
    }

    /**
     * Returns the list of peers connected to the daemon.
     *
     * @return JsonResponse
     */
    public function getPeers():JsonResponse
    {
        return $this->rpcGet('peers');
    }

    /**
     * Returns information about the fee set for the remote node.
     *
     * @return JsonResponse
     */
    public function getFeeInfo():JsonResponse
    {
        return $this->rpcGet('fee');
    }
}