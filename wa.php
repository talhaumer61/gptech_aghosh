<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://whatsapp.metasquad.uk/api/create-message',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('appkey' => 'b1258cd5-2712-4511-8e4c-4912cdefb777','authkey' => '6VEJfwZv7Qcb4kNF0ftH55Dst9dAqK01zXq0ef2sIEcmY8UjNJ','to' => '923014381660','message' => 'Dear Ali
Kindly ensure to submit your child school fee payment month of August-2025 before due date to avoid any inconvenience In case of non payment of school fee by due date 15-08-2024 fine Rs 300 will be imposed with monthly fee.

All Mobile Banking Payments 
1 Bill Invoice ID: 123456789


Your cooperation is highly appreciated.

Regards 
Accounts Department 
Aghosh Complex
Your cooperation is highly appreciated.','file' => 'https://aghosh.gptech.pk/uploads/feechallans/99302431211.pdf'),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
$responseArray = json_decode($response, true);
echo $responseArray['data']['status_code'];