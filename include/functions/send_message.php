<?php

function sendMessage($phone, $message) { 

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL             => WA_URL,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_ENCODING        => '',
        CURLOPT_MAXREDIRS       => 10,
        CURLOPT_TIMEOUT         => 0,
        CURLOPT_FOLLOWLOCATION  => true,
        CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST   => 'POST',
        CURLOPT_POSTFIELDS      => array(
                                            'api_key' => WA_APPKEY
                                            , 'sender'  => WA_SENDER
                                            , 'number'  => $phone
                                            , 'message' => $message
                                        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $responseArray = json_decode($response, true);
}
?>