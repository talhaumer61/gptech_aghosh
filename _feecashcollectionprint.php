<?php
//Require Vars, DB Connection and Function Files
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

$queryFeeCollection  = $dblms->querylms("SELECT fcc.*, fee.id, std.*
                                            FROM ".FEES_COLLECTION." fcc 
                                            INNER JOIN ".FEES." fee ON fee.id = fcc.id_fee  
                                            LEFT JOIN ".STUDENTS." std ON std.std_id = fee.id_std 
                                            WHERE fcc.recepit_no  = '".cleanvars($_GET['recepitno'])."' 
                                            AND fcc.is_deleted != 1
                                            ORDER BY fcc.id DESC LIMIT 1");
if(mysqli_num_rows($queryFeeCollection) > 0) {

    $valueFeeCollection = mysqli_fetch_array($queryFeeCollection);

    $paidDate = '';
    if($valueFeeCollection['dated'] != '0000-00-00'){
        $paidDate = date('d-m-Y', strtotime($valueFeeCollection['dated']));
    }

echo '
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fee Collection Slip</title>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="irstheme">
        <!-- links tags -->
        <style>
            .b-b {
                border-bottom: 1px solid #000;
                text-align:center;
            }
            body {			
                font-family: "Times New Roman", Times, serif;
            }
            td{
                line-height:18px;
            }
            th{
                line-height:18px;
            }
        </style>
    </head>
    <body>
        <table align="center">
            <thead>
                <tr>
							<td>
								<img src="uploads/Aghosh Orphan Care Homes Logo.png" style="width:90px; height: 90px; text-align: left; vertical-align: middle;">
								<br>
							</td>
							<td>
								<img src="uploads/logo.png" style="width:35px; height: 35px; text-align: left; vertical-align: middle;">
								<br>
								<img src="uploads/Tehfeez Logo.png" style="width:35px; height: 35px; text-align: left; vertical-align: middle; margin-top: 10px;">
							</td>
							<td>
								<h6 style="text-align: center;">
									<span>AGHOSH GRAMMAR HIGHER SECONDARY SCHOOL</span>
									<br><br>
									<span>TAHFEEZ UL QURAN INSTITUTE</span>
								</h6>
							</td>
							
						</tr>
            </thead>
        </table>
        <table width="960" align="center" style="text-align: left;margin-top: 30px;" >
            <thead>
                <tr>
                    <th width="105">RECEIPT NO:</th>
                    <th class="b-b" width="250">'.$valueFeeCollection['recepit_no'].'</th>
                    <th width="85">Challan #:</th>
                    <th class="b-b" width="250">'.$valueFeeCollection['challan_no'].'</th>
                    <th width="10">DATE:</th>
                    <th class="b-b">'.$paidDate.'</th>
                </tr>
            </thead>
        </table>
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="40">NAME:</th>
                    <th class="b-b">'.$valueFeeCollection['std_name'].'</th>
                </tr>
            </thead>
        </table> 
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="145">AMOUNT (in digit):</th>
                    <th class="b-b">'.number_format($valueFeeCollection['total_amount']).'</th>
                </tr>
            </thead>
        </table>    
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="155">AMOUNT (in words):</th>
                    <th class="b-b">'.convert_number_to_words($valueFeeCollection['total_amount']).' Only</th>
                </tr>
            </thead>
        </table>    
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="250">CASH/VIA CHEQUE/ DRAFT NO:</th>
                    <th class="b-b" width="450">'.get_payments($valueFeeCollection['pay_mode']).'</th>
                    <th width="40">DATE:</th>
                    <th class="b-b">'.$paidDate.'</th>
                </tr>
            </thead>
        </table>    
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="60">PURPOSE:</th>
                    <th class="b-b" width="650">'.$valueFeeCollection['remarks'].'</th>
                    <th >RECEIVED WITH THANKS</th>
                </tr>
            </thead>
        </table>    
        <table width="960" align="center" style="text-align: left; margin-top: 18px;">
            <thead>
                <tr>
                    <th width="165">ACCOUNTANT SIGN:</th>
                    <th class="b-b" width="315"></th>
                    <th width="125">CASHIER SIGN:</th>
                    <th class="b-b"></th>
                </tr>
            </thead>
        </table>
        <!--p style="margin-top:25px; text-align:center; font-size:18px;">Minhaj University Lahore, Near Hamdard, Chowk, Madar-e-Millat Road, Township, Lahore.<br>Landline: +92(0) 42 35145621-4</p-->
    </body>
</html>
<script type="text/javascript" language="javascript1.2">
    //Do print the page
    if (typeof(window.print) != "undefined") {
        window.print();
    }
</script>';
}
?>