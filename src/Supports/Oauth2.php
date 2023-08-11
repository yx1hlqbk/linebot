<?php

namespace Ianliao\Linebot\Supports;

use Ianliao\Linebot\Provider\LineProviderInterface;

class Oauth2
{
    /*
     * construct
     */
    public function __construct(public LineProviderInterface $provider) {
        //
    }

    /*
     * Issue channel access token v2.1
     */
    public function token(string $jwt) : array
    {
        $data = [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
                'client_assertion' => $jwt,
            ]
        ];

        return $this->request('post', 'token', $data);
    }

    /*
     * Verify the validity of short-lived and long-lived channel access tokens
     */
    public function verify(string $accessToken) : array
    {
        $data = [
            'query' => [
                'access_token' => $accessToken,
            ]
        ];

        return $this->request('get', 'verify', $data);
    }

    /*
     * Get all valid channel access token key IDs v2.1
     */
    public function tokens(string $jwt) : array
    {
        $data = [
            'query' => [
                'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
                'client_assertion' => $jwt,
            ]
        ];

        return $this->request('get', 'tokens/kid', $data);
    }

    /*
     * Revoke channel access token v2.1
     */
    public function revoke(string $accessToken) : array
    {
        $data = [
            'form_params' => [
                'client_id' => $this->provider->clientId,
                'client_secret' => $this->provider->clientSecret,
                'access_token' => $accessToken
            ]
        ];

        return $this->request('post', 'verify', $data);
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
            'oauth2',
            $urlPath,
            strtoupper($method),
            $header,
            $data
        );
    }
}
