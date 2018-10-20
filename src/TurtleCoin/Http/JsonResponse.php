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
     * @param int $options
     * @return string
     */
    public function toJson($options = 0):string
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * @return ResponseInterface
     */
    public function response():ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return JsonResponse
     */
    public static function make(ResponseInterface $response):JsonResponse
    {
        return new static($response);
    }
}