<?php
require_once("../include/dbsetting/lms_vars_config.php");
require_once("../include/dbsetting/classdbconection.php");
require_once("../include/functions/functions.php");
$dblms = new dblms();
require_once("../include/functions/login_func.php");
checkCpanelLMSALogin();
$yearmonth = "2024-08";

include('../phpqrcode/qrlib.php');

//$directoryName 		= 'uploads/qrcodes/'.$sesdir;
$directoryNameterm 	= '../uploads/qrcodes/'.date("Y");

if(!is_dir($directoryNameterm)){
    //Directory does not exist, so lets create it.
    mkdir($directoryNameterm, 0777);
    $content = "Options -Indexes";
    $fp = fopen($directoryNameterm."/.htaccess","wb");
    fwrite($fp,$content);
    fclose($fp);
}

$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.$directoryNameterm.DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = '../uploads/qrcodes/'.date("Y").'/';

//$barcodeText 	= trim($_POST['barcodeText']);
$barcodeType	= 'code128';
$barcodeDisplay	= 'horizontal';
$barcodeSize	= 50;
$printText		= 'true';
$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.id_type, f.id_month, f.yearmonth, f.challan_no, f.id_session, f.id_class, f.id_section, f.inquiry_formno, f.id_std, f.narration,
											f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
											c.class_id, c.class_name, c.id_classgroup, 
											cs.section_id, cs.section_name,
											st.std_id, st.std_name, st.std_fathername, st.std_regno, st.std_rollno, st.id_loginid,
											se.session_id, se.session_name
											FROM ".FEES." f
											INNER JOIN ".CLASSES." c ON c.class_id = f.id_class
											LEFT  JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section	
											LEFT  JOIN ".STUDENTS." st ON st.std_id = f.id_std	
											INNER JOIN ".SESSIONS." se ON se.session_id = f.id_session
											WHERE f.id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' 
											AND f.status = '2' AND f.yearmonth = '".$yearmonth."' 
											AND f.is_deleted != '1' AND f.id_type = '2'
											ORDER By f.id ASC");
while($feercord = mysqli_fetch_array($sqllms)){
    $challanno = $feercord['challan_no'];
    if($challanno) {

        if($feercord['id_classgroup'] == 3) {
            $challanprefix 	= 1000014000;
        } else {
            $challanprefix 	= 1000014011;
        }


        $challanNumber = $challanprefix.substr($challanno, -7);

        $filename	=	$PNG_WEB_DIR.$feercord['challan_no'].'_'.$feercord['id'].'.png';

        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'M';
        $matrixPointSize = 4;
        //default data

        $link	=	$feercord['challan_no'].'-'.$feercord['id'];
        QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        $stdname = preg_replace('/\s+/', ' ', $feercord['std_name']);
        $shortarray = explode(' ',trim($stdname));
        $firstname 	= $shortarray[0];
        $displayname =  $feercord['std_name'];
        $fathername =  $feercord['std_fathername'];

        $inqFromRegTitle = 'Reg';
        $inqFromRegVal = $feercord['std_regno'];

        $Instructions = '<ol type="1" style="margin-left:40px;">
			<li>Only Cash will be accepted.</li>
			<li>'.date('jS \of F-Y',strtotime($feercord['due_date'])).' is due date.</li>
			<li>Fine of Rs. 300/- will be charged after due date.</li>
			<li>The additional amount collected after the due date will be used for need based scholarship purposes.</li>
		</ol>';
        //echo $rowClass['challan_no'].'<br>';
        include 'vendor/autoload.php';

        $pdf_c = 'c';
        $ib_w_font = 'Lucida Grande';
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        //$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $mpdf->SetProtection(['print']);
        $mpdf->SetTitle('Test Invoice');
        $mpdf->SetAuthor('test');
        $mpdf->SetWatermarkText('Unpaid');
        // $mpdf->showWatermarkText = true;
        // $mpdf->watermark_font = $ib_w_font;
        // $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        if ($config['rtl'] == 1) {
            $mpdf->SetDirectionality('rtl');
        }

        if ($config['pdf_font'] == 'AdobeCJK') {
            $mpdf->useAdobeCJK = true;
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
        }

        ob_start();

        require 'challanformat.php';

        $html = ob_get_contents();

        ob_end_clean();

        $mpdf->WriteHTML($html);

        $mpdf->Output('../uploads/feechallans/' . $challanno . '.pdf', 'F');

                if (file_exists('../uploads/feechallans/'.$challanno.'.pdf')) {

                    echo '../uploads/feechallans/'.$challanno.'.pdf';
                } else{

                    echo 'No File';
                }

    }
    }
