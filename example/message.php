<?php

require('../vendor/autoload.php');

use Ianliao\Linebot\Line;

try {
    $line = new Line([
        'clientId' => '',
        'clientSecret' => '',
        'channelAccessToken' => ''
    ]);

    // // return empty is success
    $uuid = '';
    $result = $line->message()->push($uuid, [
        [
            'type' => 'text',
            'text' => 'hi'
        ]
    ]);
    print_r($result);

    // $result = $line->message()->quota();
    // $result = $line->message()->quotaConsumption();

    // // YYYYNNDD
    // $result = $line->message()->deliveryReply('20230724');
    // $result = $line->message()->deliveryPush('20230724');
    // $result = $line->message()->deliveryMulticast('20230724');
    // $result = $line->message()->deliveryBroadcast('20230724');
} catch (\Throwable $th) {
    echo $th->getMessage();
}