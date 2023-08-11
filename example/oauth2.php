<?php

require('../vendor/autoload.php');

use Ianliao\Linebot\Line;

try {
    $line = new Line([
        'clientId' => '',
        'clientSecret' => '',
        'channelAccessToken' => ''
    ]);

    $jwt = '';

    $result = $line->oauth2()->token($jwt);
    print_r($result);

    $result1 = $line->oauth2()->verify($result['access_token']);
    print_r($result1);

    $result2 = $line->oauth2()->tokens($jwt);
    print_r($result2);

    $result3 = $line->oauth2()->revoke($result['access_token']);
    print_r($result3);
} catch (\Throwable $th) {
    echo $th->getMessage();
}