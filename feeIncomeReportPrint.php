<?php 
//------------------------------------------------
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------

$from       = cleanvars( date('Y-m-d', strtotime($_POST['from_date'])));
$to         = cleanvars( date('Y-m-d', strtotime($_POST['to_date'])));

$mode_id = '';
$mode_name = '';
$sql1 = '';

if(!empty($_POST['pay_mode'])){
    $values = explode("|",$_POST['pay_mode']);
	$mode_id   = $values[0];
	$mode_name = $values[1];
    $sql1 = "AND f.pay_mode = '".$mode_id."' ";
}

echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Defaulter Report Print</title>
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

<body>';
if(isset($_POST['show_result'])){
    echo '
    <table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
        <tr>
            <td width="341" valign="top">
                <h2 style="text-align: center;">
                    <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                    <span>'.SCHOOL_NAME.'</span>
                </h2>';
                    $sr = 0; 
                    $sqllmsCats = $dblms->querylms("SELECT cat_id, cat_name
                                                        FROM ".FEE_CATEGORY."			   
                                                        WHERE cat_id NOT IN(9,13,14,17,3,4,5,10,11,12,15,16,18) 
                                                        AND cat_status = '1' 
                                                        AND is_deleted != '1'
                                                        ORDER BY cat_id ASC");
                    
                    if(mysqli_num_rows($sqllmsCats) > 0) {
                        echo'
                        <div style="font-size:12px;">
                            <table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" border="1" width="100%">
                                <thead>
                                    <tr>
                                        <td style="padding: 15px;" colspan="7"><h4 style="margin-top: 10px;">Fee Head Wise Income Report '.(!empty($mode_name) ? '('.$mode_name.')' : '').'</h4></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 15px;" colspan="7"><h4>From Date <u>'.cleanvars($_POST['from_date']).'</u> To <u>'.cleanvars($_POST['to_date']).'</u></h4></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold; width: 15px;">Sr #</td>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold;">Heads</td>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold; width: 100px;">School</td>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold; width: 100px;">Tehfeez</td>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold; width: 100px;">Academy</td>
                                        <td style="padding: 15px; text-align:center; font-size:12px; font-weight:bold; width: 100px;">Mess</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                $schoolTotal = 0;
                                $tehfeezTotal = 0;
                                    while($valueCats = mysqli_fetch_array($sqllmsCats)) {

                                        if($valueCats['cat_id'] == 17) {
                                            $schoolConcession = ',SUM(p.concession) AS school_concession';
                                            $tehfeezConcession = ', SUM(p.concession) AS tehfeez_concession';
                                            $bothConcession = ', SUM(p.concession) AS both_concession';
                                        } else {
                                            $schoolConcession = ' ';
                                            $tehfeezConcession = ' ';
                                            $bothConcession = ' ';
                                        }

                                        // School
                                        $sqllmsSchFee = $dblms->querylms("SELECT SUM(p.amount) AS school_cat_amount$schoolConcession
                                                                            FROM ".FEES." f				   
                                                                            INNER JOIN ".FEE_PARTICULARS." p ON p.id_fee = f.id							 
                                                                            INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
                                                                            LEFT JOIN ".STUDENTS." st ON st.std_id = f.id_std AND st.is_deleted != '1'
                                                                            WHERE f.status = '1' AND f.id_type IN (1,2)
                                                                            AND f.is_deleted != '1' AND f.paid_date BETWEEN '".$from."' AND '".$to."'
                                                                            AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                                            AND p.id_cat = '".$valueCats['cat_id']."' 
                                                                            $sql1
                                                                            AND c.class_name NOT LIKE '%tehfeez%'");
                                        $valueSchFee = mysqli_fetch_array($sqllmsSchFee);
                                        //Tehfeez
                                        $sqllmsTehFee = $dblms->querylms("SELECT SUM(p.amount) AS tehfeez_cat_amount$tehfeezConcession
                                                                            FROM ".FEES." f				   
                                                                            INNER JOIN ".FEE_PARTICULARS." p ON p.id_fee = f.id							 
                                                                            INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
                                                                            LEFT JOIN ".STUDENTS." st ON st.std_id = f.id_std AND st.is_deleted != '1'
                                                                            WHERE f.status = '1' AND f.id_type IN (1,2) 
                                                                            AND f.is_deleted != '1' AND f.paid_date BETWEEN '".$from."' AND '".$to."'
                                                                            AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                                            AND p.id_cat = '".$valueCats['cat_id']."'
                                                                            $sql1
                                                                            AND c.class_name LIKE '%tehfeez%' ");
                                        $valueTehFee = mysqli_fetch_array($sqllmsTehFee);
                                        $sr++;
                                        // echo 'school:'.$valueSchFee['school_cat_amount'];
                                        // echo 'tehfeez:'.$valueTehFee['tehfeez_cat_amount'];
                                        // Amounts 
                                        if($valueCats['cat_id'] == 17) {
                                            $school_cat_amount = $valueSchFee['school_cat_amount'] + $valueSchFee['school_concession'];
                                            $tehfeez_cat_amount = $valueTehFee['tehfeez_cat_amount'] + $valueTehFee['tehfeez_concession'];
                                        } else {
                                            $school_cat_amount = $valueSchFee['school_cat_amount'];
                                            $tehfeez_cat_amount = $valueTehFee['tehfeez_cat_amount'];
                                        }
                                        echo '
                                        <tr>
                                            <td style="padding: 15px ; text-align:center;">'.$sr.'</td>
                                            <td style="padding: 15px ; width:100px;">'.$valueCats['cat_name'].'</td> 
                                            <td style="padding: 15px ; text-align:right;">'.number_format($school_cat_amount).'</td>
                                            <td style="padding: 15px ; text-align:right;">'.number_format($tehfeez_cat_amount).'</td>
                                            <td style="padding: 15px ; text-align:right;">';
                                                if($valueCats['cat_id'] == 6) {
                                                    $acdmyTotal = $school_cat_amount + $tehfeez_cat_amount;
                                                    echo number_format($acdmyTotal);
                                                } 
                                                echo'
                                            </td>
                                            <td style="padding: 15px ; text-align:right;">';
                                                if($valueCats['cat_id'] == 8) {
                                                    $messTotal = $school_cat_amount + $tehfeez_cat_amount;
                                                    echo number_format($messTotal);
                                                }
                                                echo'
                                            </td>
                                        </tr>';
                                        $schoolTotal = $schoolTotal + $school_cat_amount;
                                        $tehfeezTotal = $tehfeezTotal + $tehfeez_cat_amount;
                                    }
                                    $grandTotal = $schoolTotal + $tehfeezTotal;
                                    echo'
                                    <tr style="font-size: 14px; text-align: center; border: 2px solid black;">
                                        <th colspan="2"> Total Amount</th>
                                        <td style="padding: 15px ; text-align: right;">'.number_format($schoolTotal).'</td>
                                        <td style="padding: 15px ; text-align: right;">'.number_format($tehfeezTotal).'</td>
                                        <td style="padding: 15px ; text-align: right;">'.number_format($acdmyTotal).'</td>
                                        <td style="padding: 15px ; text-align: right;">'.number_format($messTotal).'</td>
                                    </tr>
                                    <br>
                                    <br>
                                    <tr style="font-size: 16px; text-align: center; border: 2px solid black;">
                                        <th colspan="2" style="padding: 15px ;"> Grand Total</th>
                                        <th colspan="4" style="padding: 15px ;">'.number_format($grandTotal).'</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                    
                        <div class="page-break"></div>';
                    }
                echo '
                <span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
                <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
            </td>
        </tr>
    </table>';
}elseif(isset($_POST['show_detailed_result'])){
    echo '
    <table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
        <tr>
            <td width="341" valign="top">
                <h2 style="text-align: center;">
                    <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                    <span>'.SCHOOL_NAME.'</span>
                </h2>';
                    $sr = 0; 
                    // FEE
                    $sqllmsFee = $dblms->querylms("SELECT f.paid_date, f.status, f.total_amount, f.paid_amount, c.class_name, st.std_name, f.challan_no, f.status
                                                        FROM ".FEES." f				   						 
                                                        INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
                                                        LEFT JOIN ".STUDENTS." st ON st.std_id = f.id_std AND st.is_deleted != '1'					 
                                                        WHERE f.status = '1' AND f.id_type IN (1,2)
                                                        AND f.is_deleted != '1' AND f.paid_date BETWEEN '".$from."' AND '".$to."'
                                                        AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                        $sql1
                                                        ORDER By f.paid_date ASC");
                    if(mysqli_num_rows($sqllmsFee) > 0) {
                        echo'
                        <div style="font-size:12px;">
                            <table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" border="1" width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="8"><h4 style="margin-top: 10px;">Fee Detailed  Report '.(!empty($mode_name) ? '('.$mode_name.')' : '').'</h4></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><h4>From Date <u>'.cleanvars($_POST['from_date']).'</u> To <u>'.cleanvars($_POST['to_date']).'</u></h4></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 30px;">Sr #</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold;">STUDENT NAME</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 150px;">CLASS</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 80px;">CHALLAN NO</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 50px;">PAID DATE</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 50px;">AMOUNT</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 50px;">PAID AMOUNT</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 50px;">STATUS/MODE</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                $total_amount = 0;
                                $total_paid_amount = 0;
                                    while($valueFee = mysqli_fetch_array($sqllmsFee)) {
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td style="text-align:center;">'.$sr.'</td>
                                            <td style="width:100px;">'.$valueFee['std_name'].'</td> 
                                            <td>'.$valueFee['class_name'].'</td>
                                            <td style="text-align:center;">'.$valueFee['challan_no'].'</td>
                                            <td style="text-align:center;">'.$valueFee['paid_date'].'</td>
                                            <td style="text-align:right;">'.number_format($valueFee['total_amount']).'</td>
                                            <td style="text-align:right;">'.number_format($valueFee['paid_amount']).'</td>
                                            <td style="text-align:center;">'.get_payments($valueFee['status']).'</td>
                                        </tr>';
                                        $total_amount       = $total_amount + $valueFee['total_amount'];
                                        $total_paid_amount  = $total_paid_amount + $valueFee['paid_amount'];
                                    }
                                    echo'
                                    <tr style="font-size: 14px; text-align: center; border: 2px solid black;">
                                        <th colspan="5"> Grand Total</th>
                                        <td style="text-align: right;">'.number_format($total_amount).'</td>
                                        <td style="text-align: right;">'.number_format($total_paid_amount).'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                    
                        <div class="page-break"></div>';
                    }
                echo '
                <span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
                <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
            </td>
        </tr>
    </table>';
}


echo '
</body>
<script type="text/javascript" language="javascript1.2">
    <!--
    //Do print the page
    if (typeof(window.print) != "undefined") {
        window.print();
    }
    -->
</script>
</html>';
?>