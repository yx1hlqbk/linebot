<?php

require('../vendor/autoload.php');

use Ianliao\Linebot\Line;

try {
    $line = new Line([
        'clientId' => '',
        'clientSecret' => '',
        'channelAccessToken' => ''
    ]);

    $url = '';

    // success callback empty
    $result = $line->webhook()->set($url);
    var_dump($result);

    $result = $line->webhook()->get();
    var_dump($result);

    $result = $line->webhook()->test();
    var_dump($result);
} catch (\Throwable $th) {
    echo $th->getMessage();
}