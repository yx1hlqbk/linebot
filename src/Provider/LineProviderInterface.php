<?php

namespace Ianliao\Linebot\Provider;

interface LineProviderInterface
{
    /*
     * request to api
     */
    public function request(
        string $apiKind,
        string $urlPath,
        string $httpMethod,
        array $header,
        array $data
    ) : array;
}
