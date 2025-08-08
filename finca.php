<?php

$traceNo = rand(100000, 999999); // Generates a random numeric trace number between 6 to 12 digits

$url = 'http://103.215.112.158/api/v1/minhaj/login';
$data = [
    'username' => 'ceo@linkexchange.com.pk',
    'password' => 'lahore@123',
    'origin' => 'Minhaj',
    'traceNo' => $traceNo,
    'device' => 'model: iPhone, modelName: iPhone 8 Plus, name: iPhone, systemVersion: 16.7.8',
    'deviceId' => '998DB106A29447DC92C541A2828C1CF2'
];

$options = [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_HTTPHEADER => [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded'
    ],
    CURLOPT_POSTFIELDS => http_build_query($data)
];

$ch = curl_init();
curl_setopt_array($ch, $options);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    $error = curl_error($ch);
    echo "cURL Error: $error";
} else {
    echo "Response Code: $http_code\n";
    echo "Response: $response";
}

curl_close($ch);

?> 