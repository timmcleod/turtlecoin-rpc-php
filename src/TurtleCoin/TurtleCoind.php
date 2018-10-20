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
        return $this->request('getblockcount', []);
    }

    // TODO: Finish adding TurtleCoind RPC methods.
}