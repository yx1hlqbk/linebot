<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Exceptions\LineFormatException;
use Ianliao\Linebot\Provider\LineProviderInterface;

class Message
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Send reply message
     */
    public function reply(string $to, array $messages, bool $notificationDisabled = false) : array
    {
        $data = [
            'json' => [
                'replyToken' => $to,
                'messages' => $messages,
                'notificationDisabled' => $notificationDisabled
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/reply', $data, $header);
    }

    /*
     * Send push message
     */
    public function push(
        string $to,
        array $messages,
        bool $notificationDisabled = false,
        string|int $retryKey = '') : array
    {
        $data = [
            'json' => [
                'to' => $to,
                'messages' => $messages,
                'notificationDisabled' => $notificationDisabled
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        if (!empty($retryKey)) {
            $header['X-Line-Retry-Key'] = $retryKey;
        }

        return $this->request('post', 'message/push', $data, $header);
    }

    /*
     * Send multicast message
     */
    public function multicast(
        array $tos,
        array $messages,
        bool $notificationDisabled = false,
        string|int $retryKey = '') : array
    {
        $data = [
            'json' => [
                'to' => $tos,
                'messages' => $messages,
                'notificationDisabled' => $notificationDisabled
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        if (!empty($retryKey)) {
            $header['X-Line-Retry-Key'] = $retryKey;
        }

        return $this->request('post', 'message/multicast', $data, $header);
    }

    /*
     * Send narrowcast message
     */
    public function narrowcast(
        array $messages,
        array $recipient = [],
        array $demographic = [],
        int $limit = 100,
        bool $notificationDisabled = false,
        string|int $retryKey = '') : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
                'recipient' => $recipient,
                'filter' => [
                    'demographic' => $demographic
                ],
                'limit' => [
                    'max' => $limit
                ],
                'notificationDisabled' => $notificationDisabled
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        if (!empty($retryKey)) {
            $header['X-Line-Retry-Key'] = $retryKey;
        }

        return $this->request('post', 'message/multicast', $data, $header);
    }

    /*
     * Get narrowcast message status
     */
    public function progressNarrowcast(string|int $requestId) : array
    {
        $data = [
            'query' => [
                'requestId' => $requestId
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'progress/narrowcast', $data, $header);
    }

    /*
     * Send broadcast message
     */
    public function broadcast(array $messages, bool $notificationDisabled = false, string|int $retryKey = '') : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
                'notificationDisabled' => $notificationDisabled
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        if (!empty($retryKey)) {
            $header['X-Line-Retry-Key'] = $retryKey;
        }

        return $this->request('post', 'message/broadcast', $data);
    }

    /*
     * Get the target limit for sending messages this month
     */
    public function quota() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/quota', $data ?? [], $header);
    }

    /*
     * Get number of messages sent this month
     */
    public function quotaConsumption() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/quota/consumption', $data ?? [], $header);
    }

    /*
     * Get number of sent reply messages
     */
    public function deliveryReply(int|string $date) : array
    {
        $data = [
            'query' => [
                'data' => $date
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/delivery/reply', $data, $header);
    }

    /*
     * Get number of sent push messages
     */
    public function deliveryPush(int|string $date) : array
    {
        $data = [
            'query' => [
                'data' => $date
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/delivery/push', $data, $header);
    }

    /*
     * Get number of sent multicast messages
     */
    public function deliveryMulticast(int|string $date) : array
    {
        $data = [
            'query' => [
                'data' => $date
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/delivery/multicast', $data, $header);
    }

    /*
     * Get number of sent broadcast messages
     */
    public function deliveryBroadcast(int|string $date) : array
    {
        $data = [
            'query' => [
                'data' => $date
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/delivery/broadcast', $data, $header);
    }

    /*
     * Validate message objects of a reply message
     */
    public function validateReply(array $messages) : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/validate/reply', $data, $header);
    }

    /*
     * Validate message objects of a push message
     */
    public function validatePush(array $messages) : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/validate/push', $data, $header);
    }

    /*
     * Validate message objects of a multicast message
     */
    public function validateMulticast(array $messages) : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/validate/multicast', $data, $header);
    }

    /*
     * Validate message objects of a narrowcast message
     */
    public function validateNarrowcast(array $messages) : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/validate/narrowcast', $data, $header);
    }

    /*
     * Validate message objects of a broadcast message
     */
    public function validateBroadcast(array $messages) : array
    {
        $data = [
            'json' => [
                'messages' => $messages,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'message/validate/broadcast', $data, $header);
    }

    /*
     * Get number of units used this month
     */
    public function aggregationInfo() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/aggregation/info', $data ?? [], $header);
    }

    /*
     * Get name list of units used this month
     */
    public function aggregationList(int|string $limit = 100, int|string $start = 0) : array
    {
        $data = [
            'query' => [
                'limit' => $limit,
                'start' => $start
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'message/aggregation/list', $data, $header);
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
