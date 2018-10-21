<?php

namespace TurtleCoin\Http;

use Psr\Http\Message\ResponseInterface;
use TurtleCoin\Contracts\Arrayable;
use TurtleCoin\Contracts\Jsonable;

class JsonResponse implements Jsonable, Arrayable
{
    /** @var ResponseInterface */
    protected $response;

    /**
     * JsonResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Returns the body contents of the response.
     *
     * @return string
     */
    public function toJson():string
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * Returns array representation of the body contents of the response.
     *
     * @return array
     */
    public function toArray():array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * Returns the result field from the RPC response. If the result field
     * doesn't exist, it will return the full result as an array.
     *
     * @return mixed
     */
    public function result()
    {
        $result = $this->toArray();

        return $result['result'] ?? $result;
    }

    /**
     * Returns underlying response.
     *
     * @return ResponseInterface
     */
    public function response():ResponseInterface
    {
        return $this->response;
    }

    /**
     * Dynamically proxy method calls to the underlying response.
     *
     * @param string $method
     * @param array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->response->{$method}(...$parameters);
    }

    /**
     * Returns the body contents of the response.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}