<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Exceptions\LineFormatException;
use Ianliao\Linebot\Provider\LineProviderInterface;

class Insight
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Get number of message deliveries
     */
    public function messageDelivery(string $date) : array
    {
        $data = [
            'query' => [
                'date' => $date,
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'insight/message/delivery', $data, $header);
    }

    /*
     * Get number of followers
     */
    public function followers(string $date) : array
    {
        $data = [
            'query' => [
                'date' => $date,
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'insight/followers', $data, $header);
    }

    /*
     * Get user interaction statistics
     */
    public function messageEvent(string $requestId) : array
    {
        $data = [
            'query' => [
                'requestId' => $requestId,
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'insight/message/event', $data, $header);
    }

    /*
     * Get statistics per unit
     */
    public function messageEventAggregation(string $customAggregationUnit, string $from, string $to) : array
    {
        $data = [
            'query' => [
                'customAggregationUnit' => $customAggregationUnit,
                'from' => $from,
                'to' => $to
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'insight/message/event', $data, $header);
    }

    /*
     * provider request
     */
    public function request(string $method, string $urlPath, array $data = [], array $header = []) : array
    {
        return $this->provider->request(
            'bot',
            $urlPath,
            strtoupper($method),
            $header,
            $data
        );
    }
}
