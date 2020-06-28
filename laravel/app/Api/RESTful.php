<?php

namespace Framework\Api;

use GuzzleHttp\Client;

class RESTful {
    /**
     * GuzzleHttp\Client
     */
    protected $client;

    /**
     * Default headers
     */
    const DEFAULT_HEADERS = [
        'X-HTTP-Method-Override' => '',
        'Content-Type' => 'application/json',
        'Transaction' => '',
        'Token' => ''
    ];

    /**
     * default timeout
     */
    const DEFAULT_TIMEOUT = 30;

    public function __construct() {
        $this->client = new Client(['http_errors' => false, 'verify' => false]);
    }

    /**
     * Request from a service
     *
     * @param string $service
     * @param string $uri
     * @param string $method
     * @param mixed $params
     * @param string $httpMethodOverride
     * @param array $headers
     * @param bool $async
     * @return GuzzleHttp\Promise\Promise|GuzzleHttp\Psr7\Response
     */
    public function requestService(
        string $service,
        string $uri,
        string $method = 'get',
        $params = [],
        string $httpMethodOverride = '',
        array $headers = [],
        bool $async = false
    ) {
        $party = app('api.token')->party($service);

        $uri = $party['url'] . ( $party['url'][ strlen($party['url']) - 1 ] === '/' ? '' : '/' )
                             . ( $uri[0] === '/' ? substr($uri, 1) : $uri );

        return $this->{'request' . ($async ? 'Async' : '')}(
            $uri,
            $method,
            $params,
            $httpMethodOverride,
            $headers
        );
    }

    /**
     * Request
     *
     * @param string $uri
     * @param string $method
     * @param mixed $params
     * @param string $httpMethodOverride
     * @param array $headers
     * @return GuzzleHttp\Psr7\Response
     */
    public function request(string $uri, string $method = 'get', $params = [], string $httpMethodOverride = '', array $headers = []) {
        $headers = $this->buildHeaders($httpMethodOverride, $headers);

        try {
            $response = $this->client->request(
                $method,
                $uri,
                [
                    'headers' => $headers,
                    strtolower($method) === 'get' ? 'query' : 'body'
                        => strtolower($method) === 'get' ? $params : json_encode($params),
                    'timeout' => self::DEFAULT_TIMEOUT,
                ]
            );
        }
        catch (\Exception $ex) {
            $response = $ex;
        }

        app('api.log.requester')->log(
            compact('method', 'uri', 'params', 'headers'),
            ($response instanceof \Exception) ? $response->getMessage() : $response
        );

        if ($response instanceof \GuzzleHttp\Psr7\Response) {
            $response->getBody()->rewind();
        }

        return $response;
    }

    /**
     * Request Async
     *
     * @param string $uri
     * @param string $method
     * @param mixed $params
     * @param string $httpMethodOverride
     * @param array $headers
     * @return GuzzleHttp\Promise\Promise
     */
    public function requestAsync(string $uri, string $method = 'get', $params = [], string $httpMethodOverride = '', array $headers = []) {
        $headers = $this->buildHeaders($httpMethodOverride, $headers);

        $promise = $this->client->requestAsync(
            $method,
            $uri,
            [
                'headers' => $headers,
                strtolower($method) === 'get' ? 'query' : 'body'
                    => strtolower($method) === 'get' ? $params : json_encode($params),
            ]
        );

        app('api.log.requester')->log(
            compact('method', 'uri', 'params', 'headers'),
            $promise,
            true
        );

        return $promise;
    }

    /**
     * Build Headers
     *
     * @param string $httpMethodOverride
     * @param array $headers
     * @return array
     */
    protected function buildHeaders(string $httpMethodOverride, array $headers) {
        $result = array_merge(self::DEFAULT_HEADERS, $headers);

        if (!empty(trim(strval($httpMethodOverride)))) {
            $result['X-HTTP-Method-Override'] = $httpMethodOverride;
        } else {
            unset($result['X-HTTP-Method-Override']);
        }

        $this->transaction();
        $result['Transaction'] = app('transaction')->get();
        $result['Token'] = app('api.token')->buildToken();

        return $result;
    }

    protected function transaction() {
        if (empty(app('transaction')->get())) {
            app('transaction')->generate();
        }
    }
}
