<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Provider\LineProviderInterface;

class Oauth
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Issue short-lived channel access token
     */
    public function accessToken() : array
    {
        $data = [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->provider->channelId,
                'client_secret' => $this->provider->clientSecret,
            ]
        ];

        return $this->request('post', 'oauth/accessToken', $data);
    }

    /*
     * Verify the validity of short-lived and long-lived channel access tokens
     */
    public function verify(string $accessToken) : array
    {
        $data = [
            'form_params' => [
                'access_token' => $accessToken
            ]
        ];

        return $this->request('post', 'oauth/verify', $data);
    }

    /*
     * Revoke short-lived or long-lived channel access token
     */
    public function revoke(string $accessToken) : array
    {
        $data = [
            'form_params' => [
                'access_token' => $accessToken
            ]
        ];

        return $this->request('post', 'oauth/verify', $data);
    }

    /*
     * provider request
     */
    public function request(string $method, string $urlPath, array $data = []) : array
    {
        $header = [
            'Content-Type' => 'application/x-www-form-urlencoded'
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
