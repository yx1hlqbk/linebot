<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Provider\LineProviderInterface;

class Audience
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Create audience for uploading user IDs (by JSON)
     */
    public function upload(
        string $description,
        bool $isIfaAudience = false, // true : IFAs false : IDs
        string $uploadDescription = '',
        array $audiences = []
    ) : array
    {
        $data = [
            'json' => [
                'description' => $description,
                'isIfaAudience' => $isIfaAudience
            ]
        ];

        if (!empty($uploadDescription)) {
            $data['json']['uploadDescription'] = $uploadDescription;
        }

        if (!empty($audiences)) {
            $data['json']['audiences'] = $audiences;
        }

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'audienceGroup/upload', $data, $header);
    }

    /*
     * Create audience for uploading user IDs (by file)
     */
    public function uploadByFile(
        string $description,
        string $file, // text/plain
        bool $isIfaAudience = false, // true : IFAs false : IDs
        string $uploadDescription = '',
    ) : array
    {
        $data = [
            'body' => [
                'description' => $description,
                'file' => $file,
                'isIfaAudience' => $isIfaAudience
            ]
        ];

        if (!empty($uploadDescription)) {
            $data['body']['uploadDescription'] = $uploadDescription;
        }

        $header = [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'audienceGroup/upload/byFile', $data, $header);
    }

    /*
     * Add user IDs or Identifiers for Advertisers (IFAs) to an audience for uploading user IDs (by JSON)
     */
    public function add(
        string|int $audienceGroupId,
        array $audiences,
        string $uploadDescription = ''
    ) : array
    {
        $data = [
            'json' => [
                'audienceGroupId' => $audienceGroupId,
                'audiences' => $audiences,
            ]
        ];

        if (!empty($uploadDescription)) {
            $data['json']['uploadDescription'] = $uploadDescription;
        }

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', 'audienceGroup/upload', $data, $header);
    }

    /*
     * Add user IDs or Identifiers for Advertisers (IFAs) to an audience for uploading user IDs (by file)
     */
    public function addByFile(
        string|int $audienceGroupId,
        string $file, // text/plain
        string $uploadDescription = '',
    ) : array
    {
        $data = [
            'body' => [
                'audienceGroupId' => $audienceGroupId,
                'file' => $file,
            ]
        ];

        if (!empty($uploadDescription)) {
            $data['body']['uploadDescription'] = $uploadDescription;
        }

        $header = [
            'Content-Type' => 'multipart/form-data',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', 'audienceGroup/upload/byFile', $data, $header);
    }

    /*
     * Create audience for click-based retargeting
     */
    public function click(string $description, string $requestId, string $clickUrl = '') : array
    {
        $data = [
            'json' => [
                'description' => $description,
                'requestId' => $requestId,
            ]
        ];

        if (!empty($clickUrl)) {
            $data['body']['clickUrl'] = $clickUrl;
        }

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'audienceGroup/click', $data, $header);
    }

    /*
     * Create audience for impression-based retargeting
     */
    public function imp(string $description, string $requestId) : array
    {
        $data = [
            'json' => [
                'description' => $description,
                'requestId' => $requestId,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('post', 'audienceGroup/imp', $data, $header);
    }

    /*
     * Rename an audience
     */
    public function rename(string|int $audienceGroupId, string $description) : array
    {
        $data = [
            'json' => [
                'description' => $description,
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', "audienceGroup/{$audienceGroupId}/updateDescription", $data, $header);
    }

    /*
     * Activate audience
     */
    public function activate(string|int $audienceGroupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', "audienceGroup/{$audienceGroupId}/activate", $data ?? [], $header);
    }

    /*
     * Delete audience
     */
    public function delete(string|int $audienceGroupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', "audienceGroup/{$audienceGroupId}", $data ?? [], $header);
    }

    /*
     * Get audience data
     */
    public function get(string|int $audienceGroupId) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', "audienceGroup/{$audienceGroupId}", $data ?? [], $header);
    }

    /*
     * Get the authority level of the audience
     */
    public function getAuthorityLevel() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'audienceGroup/authorityLevel', $data ?? [], $header);
    }

    /*
     * Change the authority level of the audience
     */
    public function updateAuthorityLevel(string $authorityLevel) : array
    {
        $data = [
            'json' => [
                'authorityLevel' => $authorityLevel
            ]
        ];

        $header = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('put', 'audienceGroup/authorityLevel', $data, $header);
    }

    /*
     * Get data for multiple audiences
     */
    public function getList(
        int $page = 1,
        int $size = 20,
        string $description = '',
        string $status = '',
        bool $includesExternalPublicGroups = true,
        string $createRoute = ''
    ) : array
    {
        $data = [
            'query' => [
                'page' => $page,
                'size' => $size > 40 ? 40 : $size,
                'includesExternalPublicGroups' => $includesExternalPublicGroups
            ]
        ];

        if (!empty($description)) {
            $data['query']['description'] = $description;
        }

        if (!empty($status)) {
            $data['query']['status'] = $status;
        }

        if (!empty($createRoute)) {
            $data['query']['createRoute'] = $createRoute;
        }

        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->request('get', 'audienceGroup/list', $data, $header);
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
