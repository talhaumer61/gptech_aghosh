<?php
require_once("../include/dbsetting/lms_vars_config.php");
ini_set('memory_limit', '-1');
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");

// ✅ include Snappy
require __DIR__ . '/../vendor/autoload.php';
use Knp\Snappy\Pdf;

$dblms = new dblms();

// Example values (you'll replace these with real ones from DB or loop)
$challanNo = '99302542664';
$cellno = '923166752397';
$message = 'Your fee challan is ready. Please find the attached PDF for details.';

// Load the HTML content from your existing fee challan layout
ob_start();
$_GET['id'] = $challanNo;
require "../include/prints/feechallans/singlewa.php";
$html = ob_get_clean();
// ✅ Generate PDF using Snappy
$binaryPath = __DIR__ . '/../wkhtmltopdf/bin/wkhtmltopdf.exe'; // Adjust path as needed
$snappy = new Pdf($binaryPath);

$snappy->setOption('page-size', 'A4');
$snappy->setOption('orientation', 'Landscape');

$dir = 'uploads/whatsapp_pdfs';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$filePath = $dir . '/challan_' . $challanNo . '.pdf';

// Generate and save the PDF
file_put_contents($filePath, $snappy->getOutputFromHtml($html));

// ✅ Send via WhatsApp (MetaSquad API)
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://whatsapp.metasquad.uk/api/create-message',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'appkey'   => WA_APPKEY,
        'authkey'  => WA_AUTHKEY,
        'to'       => $cellno,
        'message'  => $message,
        'file'     => new CURLFile($filePath),
    ),
));

$response = curl_exec($curl);
curl_close($curl);

// Optional debug output
$responseArray = json_decode($response, true);
echo "<pre>";
print_r($responseArray);

