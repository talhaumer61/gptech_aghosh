<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();
$yearmonth 	= (isset($_REQUEST['yearmonth']) && $_REQUEST['yearmonth'] != '') ? $_REQUEST['yearmonth'] : '';
$idclass 	= (isset($_REQUEST['idclass']) && $_REQUEST['idclass'] != '') ? $_REQUEST['idclass'] : '';
$yearmonth = "2024-08";


echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Challans for WA</title>
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 portrait;
	   margin: 4mm 4mm 4mm 4mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:10px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:18px; font-weight:700; text-transform:uppercase; }
h4 { 
	text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:15px; font-weight:700; word-spacing:0.1em;  
}
td { padding-bottom:4px; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light"; }
.line1 { border:1px solid #333; width:100%; margin-top:2px; margin-bottom:5px; }
.payable { border:2px solid #000; padding:2px; text-align:center; font-size:14px; }

.paid:after
{
    content:"PAID";
	
    position:absolute;
    top:30%;
    left:20%;
    z-index:1;
    font-family:Arial,sans-serif;
    -webkit-transform: rotate(-5deg); /* Safari */
    -moz-transform: rotate(-5deg); /* Firefox */
    -ms-transform: rotate(-5deg); /* IE */
    -o-transform: rotate(-5deg); /* Opera */
    transform: rotate(-5deg);
    font-size:250px;
    color:green;
    background:#fff;
    border:solid 4px yellow;
    padding:5px;
    border-radius:5px;
    zoom:1;
    filter:alpha(opacity=50);
    opacity:0.1;
    -webkit-text-shadow: 0 0 2px #c00;
    text-shadow: 0 0 2px #c00;
    box-shadow: 0 0 2px #c00;
}
</style>
<link rel="shortcut icon" href="images/favicon/favicon.ico">
</head>

<body>
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
            <h2 style="text-align: center;">
                <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                <span style="">Aghosh Grammar School</span>
            </h2>';


$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.id_type, f.id_month, f.yearmonth, f.challan_no, f.id_session, f.id_class, f.id_section, f.inquiry_formno, f.id_std, f.narration,
											f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
											c.class_id, c.class_name, c.id_classgroup, 
											cs.section_id, cs.section_name, st.std_whatsapp, st.std_phone,
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


                        echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                       
                                        <tr>
                                            <td colspan="6"><h4 style="margin: 5px; color: #000;">Fee Collection Summary ('.date("F, Y", strtotime($yearmonth)).')</h4></td>
                                        </tr>
                                        
                                        <tr>
                                            <th width="50">Challan #</th>
                                            <th width="50">1Bill #</th>
                                            <th style="text-align:left;">Class</th>
                                            <th>Student</th>
                                            <th>Cell #</th>
											<th width="100">Monthly Fee</th>
											<th width="100">Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        while($rowClass = mysqli_fetch_array($sqllms)){

                                            if($rowClass['id_classgroup'] == 3) {
                                                $challanprefix 	= 1000014000;
                                            } else {
                                                $challanprefix 	= 1000014011;
                                            }
                                            $challanno = $rowClass['challan_no'];
                                            $challanNumber = $challanprefix.substr($challanno, -7);
                                            if($rowClass['std_whatsapp']) {
                                                $mobilenum1 = '92'.str_replace('-', '', ltrim($rowClass['std_whatsapp'], '0'));
                                            } else  if($rowClass['std_phone']) {
                                                $mobilenum1 = '92'.str_replace('-', '', ltrim($rowClass['std_phone'], '0'));
                                            } else {
                                                $mobilenum1 = '';
                                            }
                                            if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {

                                                $curl = curl_init();

                                                curl_setopt_array($curl, array(
                                                    CURLOPT_URL => 'https://wa.metasquad.uk/api/create-message',
                                                    CURLOPT_RETURNTRANSFER => true,
                                                    CURLOPT_ENCODING => '',
                                                    CURLOPT_MAXREDIRS => 10,
                                                    CURLOPT_TIMEOUT => 0,
                                                    CURLOPT_FOLLOWLOCATION => true,
                                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                                    CURLOPT_POSTFIELDS => array('appkey' => 'b3af15ce-ade3-469a-9210-a6516da8b1f7','authkey' => '8YfWfi4tSVVhkLYuo3KYcd0EMHutMAReySWFfRGoGpBACaZ6DT','to' => $mobilenum1,'message' => 'Dear '.$rowClass['std_name'].'
Kindly ensure to submit your child school fee payment month of '.get_monthtypes($rowClass['id_month']).'-'.date('Y' , strtotime(cleanvars($rowClass['due_date']))).' before due date to avoid any inconvenience In case of non payment of school fee by due date '.date('d-m-Y', strtotime($rowClass['due_date'])).' fine Rs 300 will be imposed with monthly fee.

All Mobile Banking Payments 
1 Bill Invoice ID: '. $challanNumber.'


Your cooperation is highly appreciated.

Regards 
Accounts Department 
Aghosh Complex','file' => 'https://aghosh.gptech.pk/uploads/feechallans/'.$rowClass['challan_no'].'.pdf'),
                                                ));

                                                $response = curl_exec($curl);

                                                curl_close($curl);
                                                //echo $response;


                                                echo '
                                                <tr>
                                                    <td style="text-align: center;">' . $rowClass['challan_no'] . '</td>
                                                    <td style="text-align: center;">' . $challanNumber . '</td>
                                                    <td>' . $rowClass['class_name'] . '</td>
                                                    <td style="text-align: center;">' . ($rowClass['std_name']) . '</td>                                                  
                                                    <td style="text-align: center;">' . $mobilenum1 . '</td>                                                  
                                                    <td style="text-align: right;">' . number_format($rowClass['total_amount']) . '</td>
                                                    <td style="text-align: right;">' . $response . '</td>
                                                </tr>';



                                            }
                                            }

                                        echo'
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
</body>

</html>';
?>