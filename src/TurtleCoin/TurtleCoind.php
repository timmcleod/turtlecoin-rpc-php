<?php

namespace TurtleCoin;

use TurtleCoin\Http\RpcClient;

/**
 * Wrapper for TurtleCoin's TurtleCoind JSON-RPC interface.
 * @package TurtleCoin
 */
class TurtleCoind extends RpcClient
{
    /** @var int */
    protected $rpcPort = 11898;
}