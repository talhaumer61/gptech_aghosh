<?php

require_once("../include/dbsetting/lms_vars_config.php");
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
require __DIR__ . '/../vendor/autoload.php'; // Dompdf autoload

use Dompdf\Dompdf;
use Dompdf\Options;

ini_set('memory_limit', '-1');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);

// 1. Database Connection
$dblms = new dblms();

// 2. Sample Data
$challanNo = '99302542664';
$cellno = '923166752397';
$message = 'Your fee challan is ready. Please find the attached PDF for details.';

// 3. Generate HTML from included PHP template
$_GET['id'] = $challanNo;
ob_start();
include("../include/prints/feechallans/singlewa.php");
$htmlContent = ob_get_clean();

// 4. Wrap in full HTML structure for Dompdf
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }
        .page {
            page-break-inside: avoid;
            width: 100%;
            margin: 0 auto;
            table-layout: fixed;
        }
    </style>

</head>
<body>
    '.$htmlContent .'
</body>
</html>';
echo $html; // For debugging, remove in production
exit;
// 5. Output Directory
$dir = __DIR__ . '/../uploads/whatsapp_pdfs';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// 6. PDF Generation using Dompdf
try {
    $options = new Options();
    $options->set('isRemoteEnabled', true); // For external images like logos

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Landscape like mPDF
    $dompdf->render();

    $fileName = 'challan_' . $challanNo . '.pdf';
    $filePath = $dir . '/' . $fileName;

    // Save PDF to server
    file_put_contents($filePath, $dompdf->output());
    // file_put_contents('debug.html', $html);


} catch (Exception $e) {
    die('PDF generation failed: ' . $e->getMessage());
}

// 7. Send via WhatsApp using MetaSquad API
// If your WhatsApp API accepts file URLs, make sure this path is publicly accessible
// $publicUrl = 'https://yourdomain.com/uploads/whatsapp_pdfs/' . $fileName;

// $curl = curl_init();
// curl_setopt_array($curl, [
//     CURLOPT_URL => 'https://whatsapp.metasquad.uk/api/create-message',
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_CUSTOMREQUEST => 'POST',
//     CURLOPT_POSTFIELDS => [
//         'appkey'  => WA_APPKEY,
//         'authkey' => WA_AUTHKEY,
//         'to'      => $cellno,
//         'message' => $message,
//         // 'file'    => $publicUrl, // Uncomment and provide valid URL if supported
//     ],
// ]);

// $response = curl_exec($curl);
// curl_close($curl);

// // 8. Handle WhatsApp API response
// $responseArray = json_decode($response, true);
// print_r($responseArray);
// exit;

// 9. Optional: Update WhatsApp message status in DB
/*
$status = (isset($responseArray['data']['status_code']) && $responseArray['data']['status_code'] == 200) ? 1 : 3;
$dblms->Update(WHATSAPP_MESSAGES, ['status' => $status], "id = '" . $listwa['id'] . "'");
*/
