<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Provider\LineProviderInterface;

class Content
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Get content
     */
    public function get(string|int $messageId) : array
    {
        return $this->request('get', "message/{$messageId}/content");
    }

    /*
     * Verify the preparation status of a video or audio for getting
     */
    public function transcoding(string|int $messageId) : array
    {
        return $this->request('get', "message/{$messageId}/content/transcoding");
    }

    /*
     * Get a preview image of the image or video
     */
    public function preview(string|int $messageId) : array
    {
        return $this->request('get', "message/{$messageId}/content/preview");
    }

    /*
     * provider request
     */
    public function request(string $method, string $urlPath, array $data = []) : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->provider->request(
            'data',
            $urlPath,
            strtoupper($method),
            $header,
            $data
        );
    }
}
