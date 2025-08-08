<?php
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

if(!empty($_POST['id_classgroup'])){
    $values = explode("|",$_POST['id_classgroup']);
	$group_id   = $values[0];
	$group_name = $values[1];

    $sqllms	= $dblms->querylms("SELECT GROUP_CONCAT(class_id) as class_ids
                                    FROM ".CLASSES."
                                    WHERE class_id != ''
                                    AND id_classgroup =  '".$group_id."'
                                ");
    if(mysqli_num_rows($sqllms) > 0){
        $rowClass = mysqli_fetch_array($sqllms);
    }
}

$date = new DateTime($_POST['yearmonth'] . '-01');
$month_days = $date->format('t');
echo'
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Income & Expenses Report Print</title>
        <link rel="shortcut icon" href="assets/images/favicon.png">
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
            h2 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:24px; font-weight:700; text-transform:uppercase; }
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
            echo'
            <table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
                <tr>
                    <td width="341" valign="top">
                        <h2 style="text-align: center;">
                            <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                            <span>'.SCHOOL_NAME.'</span>
                        </h2>
                        <div style="font-size:12px;">
                            <table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" border="1" width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="7"><h2>'.$group_name.'</h2></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"><h4>Monthly Income & Expenses</h4></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"><h4>Month of '.date('F-Y', strtotime($_POST['yearmonth'])).'</h4></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 15px;">Sr.</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Date</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold;">Description</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">V#</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Cash Collection</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Online Collection</td>
                                        <td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Expenses</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $total = array();
                                    for ($i=1; $i <+ $month_days; $i++) { 
                                        $i = ($i<10 ? '0'.$i : $i);
                                        // FEES
                                        $sqlFees = $dblms->querylms("SELECT
                                                                        SUM(CASE WHEN f.pay_mode = 1 THEN f.paid_amount ELSE 0 END) AS cash_pay
                                                                        ,SUM(CASE WHEN f.pay_mode = 6 THEN f.paid_amount ELSE 0 END) AS online_pay
                                                                        FROM ".FEES." f
                                                                        WHERE f.status      = '1'
                                                                        AND f.is_deleted    = '0'
                                                                        AND f.paid_date     = '".cleanvars($_POST['yearmonth'])."-".$i."'
                                                                        AND f.id_class IN (".$rowClass['class_ids'].")
                                                                    ");                                        
                                        // EXPENSES
                                        $sqlExpenses = $dblms->querylms("SELECT d.remarks, d.deposit_slip, d.amount
                                                                        FROM ".FEES_COLLECTION_BANK_DEPOSIT." d
                                                                        WHERE d.is_deleted  = '0'
                                                                        AND d.date          = '".cleanvars($_POST['yearmonth'])."-".$i."'
                                                                    ");                                        
                                        if(mysqli_num_rows($sqlFees) > 0){
                                            $valFees = mysqli_fetch_array($sqlFees);
                                            $sr++;
                                            echo '
                                            <tr>
                                                <td style="text-align:center;">'.$sr.'</td>
                                                <td style="width:100px; text-align: center;">'.cleanvars($_POST['yearmonth'])."-".$i.'</td>
                                                <td>Fee Collection</td>
                                                <td></td>
                                                <td style="text-align:right;">'.number_format($valFees['cash_pay']).'</td>
                                                <td style="text-align:right;">'.number_format($valFees['online_pay']).'</td>
                                                <td></td>
                                            </tr>';
                                            $total['cash_pay'] += $valFees['cash_pay'];
                                            $total['online_pay'] += $valFees['online_pay'];
                                        }
                                        if(mysqli_num_rows($sqlExpenses) > 0){
                                            while($valExpenses = mysqli_fetch_array($sqlExpenses)){
                                                if($valExpenses['amount'] > 0){
                                                    $sr++;
                                                    echo'
                                                    <tr>
                                                        <td style="text-align:center;">'.$sr.'</td>
                                                        <td style="width:100px; text-align: center;">'.cleanvars($_POST['yearmonth'])."-".$i.'</td>
                                                        <td>'.$valExpenses['remarks'].'</td>
                                                        <td>'.$valExpenses['deposit_slip'].'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="text-align:right;">'.number_format($valExpenses['amount']).'</td>
                                                    </tr>';
                                                    $total['amount'] += $valExpenses['amount'];
                                                }
                                            }
                                        }
                                    }
                                    echo'
                                    <tr style="font-size: 14px; text-align: center; border: 2px solid black;">
                                        <th colspan="4"> Total Amount</th>
                                        <th style="text-align: right;">'.number_format($total['cash_pay']).'</th>
                                        <th style="text-align: right;">'.number_format($total['online_pay']).'</th>
                                        <th style="text-align: right;">'.number_format($total['amount']).'</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="page-break"></div>
                        <span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
                        <span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
                    </td>
                </tr>
            </table>';
        }
        echo'
    </body>
    <script type="text/javascript" language="javascript1.2">
        //Do print the page
        if (typeof(window.print) != "undefined") {
            // window.print();
        }
    </script>
</html>';
?>