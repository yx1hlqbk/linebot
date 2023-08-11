<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Exceptions\LineFormatException;
use Ianliao\Linebot\Provider\LineProviderInterface;

class Group
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Get group chat summary
     */
    public function summary(string $groupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "group/{$groupId}/summary", $data ?? [], $header);
    }

    /*
     * Get number of users in a group chat
     */
    public function membersCount(string $groupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "group/{$groupId}/members/count", $data ?? [], $header);
    }

    /*
     * Get group chat member user IDs
     */
    public function membersIds(string $groupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "group/{$groupId}/members/ids", $data ?? [], $header);
    }

    /*
     * Get group chat member profile
     */
    public function member(string $groupId, string $userId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "group/{$groupId}/member/{$userId}", $data ?? [], $header);
    }

    /*
     * Leave group chat
     */
    public function leave(string $groupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', "group/{$groupId}/leave", $data ?? [], $header);
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
