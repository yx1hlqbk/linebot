<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Provider\LineProviderInterface;

class Webhook
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Set webhook endpoint URL
     */
    public function set(string $url) : array
    {
        $data = [
            'json' => [
                'endpoint' => $url
            ]
        ];

        return $this->request('put', 'channel/webhook/endpoint', $data);
    }

    /*
     * Get webhook endpoint information
     */
    public function get() : array
    {
        return $this->request('get', 'channel/webhook/endpoint');
    }

    /*
     * Test webhook endpoint
     */
    public function test(string $url) : array
    {
        $data = [
            'json' => [
                'endpoint' => $url
            ]
        ];

        return $this->request('post', 'channel/webhook/test', $data);
    }

    /*
     * provider request
     */
    public function request(string $method, string $urlPath, array $data = []) : array
    {
        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->provider->request(
            'bot',
            $urlPath,
            strtoupper($method),
            $header,
            $data
        );
    }
}
