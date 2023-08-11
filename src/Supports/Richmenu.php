<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Exceptions\LineFormatException;
use Ianliao\Linebot\Provider\LineProviderInterface;

class Richmenu
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Create rich menu
     */
    public function create(array $content) : array
    {
        $data = [
            'json' => $content
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'post', 'richmenu', $data, $header);
    }

    /*
     * Validate rich menu object
     */
    public function validate(array $content) : array
    {
        $data = [
            'json' => $content
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'post', 'richmenu/validate', $data, $header);
    }

    /*
     * Upload rich menu image
     */
    public function uploadImg(string $richMenuId, string $img) : array
    {
        $data = [
            'body' => $img
        ];

        $header = [
            'Content-Type' => 'image/jpeg',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(2, 'post', "richmenu/{$richMenuId}/content", $data, $header);
    }

    /*
     * Download rich menu image
     */
    public function downloadImg(string|int $richMenuId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(2, 'get', "richmenu/{$richMenuId}/content", $data ?? [], $header);
    }

    /*
     * Get rich menu list
     */
    public function getList() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'get', 'richmenu/list', $data ?? [], $header);
    }

    /*
     * Get rich menu
     */
    public function get(string|int $richMenuId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'get', "richmenu/{$richMenuId}", $data ?? [], $header);
    }

    /*
     * Delete rich menu
     */
    public function delete(string|int $richMenuId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'delete', "richmenu/{$richMenuId}", $data ?? [], $header);
    }

    /*
     * Set default rich menu
     */
    public function setDefault(string|int $richMenuId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'post', "user/all/richmenu/{$richMenuId}", $data ?? [], $header);
    }

    /*
     * Get default rich menu ID
     */
    public function getDefaultList() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'get', 'user/all/richmenu', [], $header);
    }

    /*
     * Cancel default rich menu
     */
    public function cancelDefault() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request(1, 'delete', 'user/all/richmenu', $data ?? [], $header);
    }

    /*
     * Create rich menu alias
     */
    public function createAlias(string $richMenuAliasId, string $richMenuId) : array
    {
        $data = [
            'json' => [
                'richMenuAliasId' => $richMenuAliasId,
                'richMenuId' => $richMenuId
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'post', 'richmenu/alias', $data, $header);
    }

    /*
     * Delete rich menu alias
     */
    public function deleteAlias(string $richMenuAliasId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'delete', "richmenu/alias/{$richMenuAliasId}", $data ?? [], $header);
    }

    /*
     * Update rich menu alias
     */
    public function updateAlias(string $richMenuAliasId, string $richMenuId) : array
    {
        $data = [
            'json' => [
                'richMenuId' => $richMenuId
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'post', "richmenu/alias/{$richMenuAliasId}", $data, $header);
    }

    /*
     * Get rich menu alias information
     */
    public function gerAlias(string $richMenuAliasId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'get', "richmenu/alias/{$richMenuAliasId}", $data ?? [], $header);
    }

    /*
     * Get list of rich menu alias
     */
    public function gerAliasList() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'get', 'richmenu/alias/list', $data ?? [], $header);
    }

    /*
     * Link rich menu to user
     */
    public function userLink(string $userId, string $richMenuId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'post', "user/{$userId}/richmenu/{$richMenuId}", $data ?? [], $header);
    }

    /*
     * Link rich menu to multiple users
     */
    public function usersLink(array $userIds, string $richMenuId) : array
    {
        $data = [
            'json' => [
                'richMenuId' => $richMenuId,
                'userIds' => $userIds
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'post', 'richmenu/bulk/link', $data, $header);
    }

    /*
     * Get rich menu ID of user
     */
    public function getByUserId(array $userId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'get', "user/{$userId}/richmenu", $data ?? [], $header);
    }

    /*
     * Unlink rich menu from user
     */
    public function deleteByUserId(string $userId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'delete', "user/{$userId}/richmenu", $data ?? [], $header);
    }

    /*
     * Unlink rich menus from multiple users
     */
    public function deleteByUserIds(array $userIds) : array
    {
        $data = [
            'json' => [
                'userIds' => $userIds
            ]
        ];

        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'post', 'richmenu/bulk/unlink', $data, $header);
    }

    /*
     * Replace or unlink the linked rich menus in batches
     */
    public function replaceBatch(array $operations, string $resumeRequestKey = '') : array
    {
        $data = [
            'json' => [
                'operations' => $operations,
            ]
        ];

        if (!empty($resumeRequestKey)) {
            $data['json']['resumeRequestKey'] = $resumeRequestKey;
        }

        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'post', 'richmenu/batch', $data, $header);
    }

    /*
     * Get the status of rich menu batch control
     */
    public function progressBatch(array $userIds) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization,
        ];

        return $this->request(1, 'post', 'richmenu/progress/batch', $data ?? [], $header);
    }

    /*
     * Validate a request of rich menu batch control
     */
    public function validateBatch(array $operations, string $resumeRequestKey = '') : array
    {
        $data = [
            'json' => [
                'operations' => $operations,
            ]
        ];

        if (!empty($resumeRequestKey)) {
            $data['json']['resumeRequestKey'] = $resumeRequestKey;
        }

        $header = [
            'Authorization' => $this->provider->authorization,
            'Content-Type' => 'application/json'
        ];

        return $this->request(1, 'post', 'richmenu/validate/batch', $data, $header);
    }

    /*
     * provider request
     */
    public function request(
        int $type,
        string $method,
        string $urlPath,
        array $data = [],
        array $header = []) : array
    {
        return $this->provider->request(
            $type == 1 ? 'bot' : 'data',
            $urlPath,
            strtoupper($method),
            $header,
            $data
        );
    }
}
