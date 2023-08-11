<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Exceptions\LineFormatException;
use Ianliao\Linebot\Provider\LineProviderInterface;

class Room
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Get number of users in a multi-person chat
     */
    public function memberCount(string $roomId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "room/{$roomId}/members/count", $data ?? [], $header);
    }

    /*
     * Get multi-person chat member user IDs
     */
    public function memberIds(string $roomId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "room/{$roomId}/members/ids", $data ?? [], $header);
    }

    /*
     * Get multi-person chat member profile
     */
    public function memberInfo(string $roomId, string $userId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "room/{$roomId}/members/{$userId}", $data ?? [], $header);
    }

    /*
     * Leave group chat
     */
    public function leave(string $roomId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', "room/{$roomId}/leave", $data ?? [], $header);
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
