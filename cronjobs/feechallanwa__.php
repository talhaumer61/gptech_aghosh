<?php
require_once("../include/dbsetting/lms_vars_config.php");
ini_set('memory_limit', '-1');
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");

require __DIR__ . '/../vendor/autoload.php';
use Knp\Snappy\Pdf;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);

// Snappy PDF Setup
$binaryPath = __DIR__ . '/../wkhtmltopdf/bin/wkhtmltopdf.exe'; // your local path
$snappy = new Pdf($binaryPath);
$snappy->setOption('page-size', 'A4');
$snappy->setOption('orientation', 'Landscape');

// Database connection
$dblms = new dblms();

// WhatsApp messages to process
// $conditions = array(
//     'select'      => '*',
//     'where'       => array('status' => 0),
//     'search_by'   => " AND message_type IN (1,3)",
//     'order_by'    => " dated ASC",
//     'limit'       => 30,
//     'return_type' => 'all'
// );
// $Adminslist = $dblms->getRows(WHATSAPP_MESSAGES, $conditions);

// Directory for generated PDFs
$dir = 'uploads/whatsapp_pdfs';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// Loop through messages
// foreach ($Adminslist as $listwa) {
    // $challanNo = $listwa['challanno']; // ensure this exists in table
    // $cellno    = $listwa['cellno'];     // ensure this exists in table
    $challanNo = '99302542664'; // Make sure this column exists
    $cellno = '923166752397';
    $message   = 'Your fee challan is ready. Please find the attached PDF for details.';

    // Generate HTML content
    ob_start();
    $_GET['id'] = $challanNo;
    include("../include/prints/feechallans/singlewa.php");
    $html = ob_get_clean();

    // Generate PDF and save
    $filePath = $dir . '/challan_' . $challanNo . '.pdf';
    file_put_contents($filePath, $snappy->getOutputFromHtml($html));
     
    // Send via WhatsApp
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
            'file'     => 'https://aghosh.gptech.pk/login/assets/images/app_image/logo.png',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $responseArray = json_decode($response, true);
    print_r($responseArray);exit;

    // Determine status
    $status = (isset($responseArray['data']['status_code']) && $responseArray['data']['status_code'] == 200) ? 1 : 3;

    // Update DB status
    $dblms->Update(WHATSAPP_MESSAGES, array('status' => $status), "id = '" . $listwa['id'] . "'");

    // Delete PDF file
    // unlink($filePath);
// }



// require_once("../include/dbsetting/lms_vars_config.php");
// ini_set('memory_limit', '-1');
// require_once("../include/dbsetting/classdbconection.php");
// require_once("../include/functions/functions.php");
// require_once("../dompdf/vendor/autoload.php");
// $dblms = new dblms();

    // $conditions = array (
    //                                  'select' 		=> '*'
    //                                , 'where' 		=> array (
    //                                                                 'status' => 0
    //                                                         )
    //                                , 'search_by' 	=> " AND message_type IN (1,3)"
    //                                , 'order_by' 	=> " dated ASC"
    //                                , 'limit' 		=> 30
    //                                , 'return_type'  => 'all'
    //                     );
    // $Adminslist 	= $dblms->getRows(WHATSAPP_MESSAGES,  $conditions);

    // use Dompdf\Dompdf;
    // foreach ($Adminslist as $listwa) {
        // $challanNo = '99302542664'; // Make sure this column exists
        // $cellno = '923166752397';
        // $message = 'Your fee challan is ready. Please find the attached PDF for details.';

        // Load the HTML content from your existing layout
        // ob_start();
        // $_GET['id'] = $challanNo;
        // include("../include/prints/feechallans/singlewa.php");
        // $html = ob_get_clean();

        // // Generate PDF with Dompdf
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'landscape');
        // $dompdf->render();

        // // Save to a temp file
        // $pdfOutput = $dompdf->output();
        // $filePath = 'uploads/whatsapp_pdfs/challan_'.$challanNo.'.pdf';
        // $dir = 'uploads/whatsapp_pdfs';
        // if (!is_dir($dir)) {
        //     mkdir($dir, 0777, true);
        // }
        // file_put_contents($filePath, $pdfOutput);

        // // Send via WhatsApp
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://whatsapp.metasquad.uk/api/create-message',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => array(
        //         'appkey'   => WA_APPKEY,
        //         'authkey'  => WA_AUTHKEY,
        //         'to'       => $cellno,
        //         'message'  => $message,
        //         'file'     => new CURLFile($filePath),
        //     ),
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);

        // $responseArray = json_decode($response, true);
        // $status = ($responseArray['data']['status_code'] == 200) ? 1 : 3;

        // Update status in database
        // $dblms->Update(WHATSAPP_MESSAGES, array('status' => $status), "id = '".($listwa['id'])."'");

        // Optional: Delete file after sending
        // unlink($filePath);
    // }
