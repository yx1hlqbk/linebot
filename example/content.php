<?php

require('../vendor/autoload.php');

use Ianliao\Linebot\Line;

try {
    $line = new Line([
        'clientId' => '',
        'clientSecret' => '',
        'channelAccessToken' => ''
    ]);

    $messageId = '';

    $result = $line->content()->get($messageId);
    print_r($result);

    $result = $line->content()->transcoding($messageId);
    print_r($result);

    $result = $line->content()->preview($urmessageId);
    print_r($result);
} catch (\Throwable $th) {
    echo $th->getMessage();
}