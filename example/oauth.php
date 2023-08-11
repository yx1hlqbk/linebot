<?php

require('../vendor/autoload.php');

use Ianliao\Linebot\Line;

try {
    $line = new Line([
        'clientId' => '',
        'clientSecret' => '',
        'channelAccessToken' => ''
    ]);

    $result = $line->oauth()->accessToken();
    print_r($result);

    $result1 = $line->oauth()->verify($result['access_token']);
    print_r($result1);

    $result2 = $line->oauth()->revoke($result['access_token']);
    print_r($result2);
} catch (\Throwable $th) {
    echo $th->getMessage();
}