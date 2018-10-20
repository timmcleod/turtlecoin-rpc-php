<?php

namespace TurtleCoin\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use stdClass;

class RpcClient
{
    /** @var ClientInterface */
    protected $client = null;

    /** @var int */
    protected $rpcId = 0;

    /** @var string */
    protected $rpcHost = 'http://127.0.0.1';

    /** @var int */
    protected $rpcPort = 80;

    /** @var string */
    protected $rpcBaseRoute = '';

    /** @var string */
    protected $rpcPassword = '';

    /**
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
     *                      rpcHost: The hostname of the service (must include http://)
     *                      rpcPort: The port number the service is listening on
     *                      rpcPassword: The password for JSON-RPC interface
     *                      rpcBaseRoute: The base path for accessing the service
     */
    public function configure(array $config = []):void
    {
        $config = array_intersect_key($config, array_flip(['rpcHost', 'rpcPort', 'rpcPassword', 'rpcBaseRoute']));

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
            'rpcHost'      => $this->rpcHost,
            'rpcPort'      => $this->rpcPort,
            'rpcPassword'  => $this->rpcPassword,
            'rpcBaseRoute' => $this->rpcBaseRoute,
        ];
    }

    /**
     * @param string $method
     * @param array  $params
     * @return JsonResponse
     */
    public function request(string $method, array $params = []):JsonResponse
    {
        $options = [
            'jsonrpc' => '2.0',
            'id'      => $this->rpcId,
            'method'  => $method,
            'params'  => $this->prepareParams($params),
        ];

        if (!empty($this->rpcPassword)) $options['password'] = $this->rpcPassword;

        $response = $this->client->post($this->uri(), [RequestOptions::JSON => $options]);

        $this->rpcId++;

        return JsonResponse::make($response);
    }

    /**
     * @param array $params
     * @return array|stdClass
     */
    protected function prepareParams(array $params)
    {
        return empty($params) ? new stdClass() : $params;
    }

    /**
     * Returns the endpoint URI.
     *
     * @return string
     */
    public function uri():string
    {
        return "$this->rpcHost:$this->rpcPort$this->rpcBaseRoute";
    }

    /**
     * @return ClientInterface
     */
    public function client():ClientInterface
    {
        return $this->client;
    }
}