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
use Ianliao\Linebot\Supports\Room;
use Ianliao\Linebot\Supports\Richmenu;

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
    public function webhook() : \Ianliao\Linebot\Supports\Webhook
    {
        return new Webhook($this->provider);
    }

    /*
     * Getting content
     */
    public function content() : \Ianliao\Linebot\Supports\Content
    {
        return new Content($this->provider);
    }

    /*
     * Channel access token v2
     */
    public function oauth2() : \Ianliao\Linebot\Supports\Oauth2
    {
        return new Oauth2($this->provider);
    }

    /*
     * Channel access token
     */
    public function oauth() : \Ianliao\Linebot\Supports\Oauth
    {
        return new Oauth($this->provider);
    }

    /*
     * Message
     */
    public function message() : \Ianliao\Linebot\Supports\Message
    {
        return new Message($this->provider);
    }

    /*
     * Managing Audience
     */
    public function audience() : \Ianliao\Linebot\Supports\Audience
    {
        return new Audience($this->provider);
    }

    /*
     * Insight
     */
    public function insight() : \Ianliao\Linebot\Supports\Insight
    {
        return new Insight($this->provider);
    }

    /*
     * Users
     */
    public function users() : \Ianliao\Linebot\Supports\Users
    {
        return new Users($this->provider);
    }

    /*
     * Room
     */
    public function room() : \Ianliao\Linebot\Supports\Room
    {
        return new Room($this->provider);
    }

    /*
     * Richmenu
     */
    public function richmenu() : \Ianliao\Linebot\Supports\Richmenu
    {
        return new Richmenu($this->provider);
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
