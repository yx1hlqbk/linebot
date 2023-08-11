<?php

namespace Ianliao\Linebot;

use Ianliao\Linebot\Provider\LineProvider;
use Ianliao\Linebot\Supports\Webhook;
use Ianliao\Linebot\Supports\Content;
use Ianliao\Linebot\Supports\Oauth2;
use Ianliao\Linebot\Supports\Oauth;
use Ianliao\Linebot\Supports\Message;
use Ianliao\Linebot\Supports\Audience;
use Ianliao\Linebot\Supports\Insight;
use Ianliao\Linebot\Supports\Users;

class Line
{
    public $provider;

    /*
     * construct
     */
    public function __construct(public array $config) {
        $this->provider = new LineProvider(
            $config['clientId'] ?? '',
            $config['clientSecret'] ?? '',
            $config['channelAccessToken'] ?? '',
        );
    }

    /*
     * Webhook settings
     */
    public function webhook() : object
    {
        return new Webhook($this->provider);
    }

    /*
     * Getting content
     */
    public function content() : object
    {
        return new Content($this->provider);
    }

    /*
     * Channel access token v2
     */
    public function oauth2() : object
    {
        return new Oauth2($this->provider);
    }

    /*
     * Channel access token
     */
    public function oauth() : object
    {
        return new Oauth($this->provider);
    }

    /*
     * Message
     */
    public function message() : object
    {
        return new Message($this->provider);
    }

    /*
     * Managing Audience
     */
    public function audience() : object
    {
        return new Audience($this->provider);
    }

    /*
     * Insight
     */
    public function insight() : object
    {
        return new Insight($this->provider);
    }

    /*
     * Users
     */
    public function users() : object
    {
        return new Users($this->provider);
    }

    /*
     * Bot info
     */
    public function info() : array
    {
        $header = [
            'Authorization' => $this->provider->authorization
        ];

        return $this->provider->request(
            'users',
            'info',
            'GET',
            $header,
            []
        );
    }
}
