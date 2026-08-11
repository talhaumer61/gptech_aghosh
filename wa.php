<?php


// $ch = curl_init("https://whatsapp.metasquad.info/send-message");

// curl_setopt_array($ch, [
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_POST => true,
//     CURLOPT_POSTFIELDS => [
//         'api_key' => 'wr6cxDJJHA9THQTt3jHRpZj2f4c8fi',
//         'sender'  => '923194000430',
//         'number'  => '923041847080',
//         'message' => 'Server Test'
//     ],
// ]);

// $response = curl_exec($ch);

// echo "<pre>";
// echo "HTTP Code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
// echo "Redirect Count: " . curl_getinfo($ch, CURLINFO_REDIRECT_COUNT) . PHP_EOL;
// echo "Final URL: " . curl_getinfo($ch, CURLINFO_EFFECTIVE_URL) . PHP_EOL;
// echo "Error: " . curl_error($ch) . PHP_EOL;
// echo "Response:" . PHP_EOL;
// echo $response;
// echo "</pre>";

// curl_close($ch);
// require_once("include/dbsetting/lms_vars_config.php");
// require_once ("include/dbsetting/classdbconection.php");
// require_once ("include/functions/functions.php");

// echo "PHP Version: " . PHP_VERSION . "<br>";
// echo "cURL Loaded: " . (extension_loaded('curl') ? 'YES' : 'NO') . "<br>";

// $ch = curl_init('https://whatsapp.metasquad.info');

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_NOBODY, true);

// curl_exec($ch);

// echo "HTTP Code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "<br>";
// echo "Error No: " . curl_errno($ch) . "<br>";
// echo "Error: " . curl_error($ch) . "<br>";

// curl_close($ch);


// echo "Testing WA API";
// $response = sendWhatsApp('923041847080', 'Test WA Message');
// echo $response;

// $url = WA_URL . '?' . http_build_query([
//     'api_key' => WA_APPKEY,
//     'sender'  => WA_SENDER,
//     'number'  => '923041847080',
//     'message' => 'Test WA Message'
// ]);

// echo "URL: " . $url . "\n";

// $curl = curl_init();

// curl_setopt_array($curl, [
//     CURLOPT_URL            => $url,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING       => '',
//     CURLOPT_MAXREDIRS      => 10,
//     CURLOPT_TIMEOUT        => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST  => 'POST',
// ]);

// $response = curl_exec($curl);

// if (curl_errno($curl)) {
//     echo 'cURL Error: ' . curl_error($curl);
// } else {
//     echo $response;
// }

// curl_close($curl);

// $responseArray = json_decode($response, true);




// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL             => WA_URL,
//     CURLOPT_RETURNTRANSFER  => true,
//     CURLOPT_ENCODING        => '',
//     CURLOPT_MAXREDIRS       => 10,
//     CURLOPT_TIMEOUT         => 0,
//     CURLOPT_FOLLOWLOCATION  => true,
//     CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST   => 'POST',
//     CURLOPT_POSTFIELDS      => array(
//                                           'api_key' => WA_APPKEY
//                                         , 'sender'  => WA_SENDER
//                                         , 'number'  => '923041847080'
//                                         , 'message' => 'Test WA Message'
//                                     ),
// ));

// $response = curl_exec($curl);
// echo $response;
// curl_close($curl);
// $responseArray = json_decode($response, true);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://whatsapp.metasquad.info/send-message?api_key=wr6cxDJJHA9THQTt3jHRpZj2f4c8fi&sender=923194000430&number=923041847080&message=Welcome%20to%20Meta%20Squad%2C%20%0Awhere%20we%20offer%20cutting-edge%20solutions%20to%20help%20to%20unlock%20your%20business%20potential%20to%20grow.%0A%22We%20offer%20premium%20quality%20services%20that%20you%20are%20sure%20to%20love%5C!%5C%22%0Ahttps%3A%2F%2Fmetasquad.info%2Fservices%0AAPI%20TEST%20DONE%20BY%20TEAM%20https%3A%2F%2Fmetasquad.info',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;