<?php 
require_once("include/dbsetting/lms_vars_config.php");
require_once("include/dbsetting/classdbconection.php");
require_once("include/functions/functions.php");
$dblms = new dblms();
require_once("include/functions/login_func.php");
checkCpanelLMSALogin();

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

<body>
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
            <h2 style="text-align: center;">
                <img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
                <span style="">'.SCHOOL_NAME.'</span>
            </h2>';

            $sql1 = "";
            $sql2 = "";
            $sql4 = "";
            $class = "";
            $std_gender = "";
            $challanName = "Fee";
            $is_hostelized = "";

            //Class Wise Defaulter                
            if($_GET['type'] == '1'){
                //  class
                if(isset($_GET['id_class2']) && !empty($_GET['id_class2'])){
                    $sql1 = "AND class_id IN (".$_GET['id_class2'].")";
                    $classComma = $_GET['id_class2'];
                    $class = explode(", ",$_GET['id_class2']);
                }
                //  gender
                if($_GET['std_gender']){
                    $sql2 = "AND st.std_gender = '".$_GET['std_gender']."'";
                    $std_gender = $_GET['std_gender'];
                }
                //Challan Types                    
                // if(isset($_GET['chltyp']) && !empty($_GET['chltyp'])){
                //     $sql3 = "AND f.id_type = '".$_GET['chltyp']."'";
                //     $challanName = get_challantype($_GET['chltyp']);
                // }
                //	is_hostelized
                if($_GET['is_hostelized']){
                    if($_GET['is_hostelized']==1){
                        $sql4 = "AND st.is_hostelized = '1'";
                        $is_hostelized = get_studenttype($_GET['is_hostelized']);
                    }else{
                        $sql4 = "AND st.is_hostelized != '1'";
                        $is_hostelized = get_studenttype($_GET['is_hostelized']);
                    }
                }
                
                $sqllmsClass = $dblms->querylms("SELECT class_id, class_name
                                                        FROM ".CLASSES."			   
                                                        WHERE class_id != '' AND class_status = '1' AND is_deleted != '1'
                                                        $sql1 ORDER BY class_id ASC");
                while($rowClass = mysqli_fetch_array($sqllmsClass)){
                    $sqllmsFeeDefaulter	= $dblms->querylms("SELECT f.id, f.status, GROUP_CONCAT('01','-',f.id_month,'-',YEAR(f.due_date)) as challan_month, f.id_class, f.challan_no, st.std_name, st.std_fathername, c.class_name, f.narration, 
                                                                SUM(
                                                                    (case when f.due_date > '".date('Y-m-d')."' then f.total_amount
                                                                    else f.total_amount + '".LATEFEE."'
                                                                    end)
                                                                ) as total,
                                                                SUM(f.paid_amount) paid
                                                                FROM ".FEES." f				   
                                                                INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
                                                                INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	
                                                                WHERE (f.status = '2' OR f.status = '4')
                                                                AND f.id_class      = ".$rowClass['class_id']." $sql2 $sql4 
                                                                AND f.id_type       = '2'
                                                                AND f.is_deleted    = '0' 
                                                                AND st.is_deleted   = '0'
                                                                AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                                                AND st.std_status   = '1'
                                                                GROUP BY st.std_id
                                                                ORDER BY st.std_id, f.id DESC");
                    if(mysqli_num_rows($sqllmsFeeDefaulter) > 0){
                        echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan="9"><h4 style="margin-top: 10px; color: red;">'.$challanName.' Defaulters Report of Class '.$rowClass['class_name'].' '.(!empty($std_gender) ? '- '.$std_gender.'' : '').' '.(!empty($is_hostelized) ? '- '.$is_hostelized.'' : '').'</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Sr #</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Challan #</td>
                                            <td style="text-align:left; font-size:12px; font-weight:bold;">Student</td>
                                            <td style="text-align:left; font-size:12px; font-weight:bold;">Narration</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Status</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Remaining</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Remarks</td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        $sr = 0; 
                                        $grandTotal = 0; 
                                        $grandPaid = 0;
                                        $grandPending = 0;
                                        //-----------------------------------------------------
                                        while($rowStudent = mysqli_fetch_array($sqllmsFeeDefaulter)){
                                            
                                            $narration = explode(",",$rowStudent['narration']);
                                            $challan_month = explode(",",$rowStudent['challan_month']);
                                            $totalAmount = $rowStudent['total'];

                                            $paidAmount = $rowStudent['paid'];
                                            $remainingAmount = $totalAmount - $paidAmount;
                                            if($remainingAmount > 0){
                                                $sr++;
                                                echo '
                                                <tr>
                                                    <td style="text-align:center; padding-left: 5px;width: 50px;">'.$sr.'</td>
                                                    <td style="width:100px; text-align:center;">'.$rowStudent['challan_no'].'</td> 
                                                    <td>'.$rowStudent['std_name'].' / '.$rowStudent['std_fathername'].'</td> 
                                                    <td style="text-align:left;">';

                                                    $arrayNar = array();
                                                    foreach ($challan_month as $nar):
                                                        $narDate = date('M-Y' , strtotime($nar));
                                                        array_push($arrayNar, $narDate);
                                                        // echo date('M-y' , strtotime($nar)).' ,';
                                                    endforeach;
                                                    $narComma 	= 	implode(", ",$arrayNar);

                                                    echo' '.$narComma.'
                                                    </td>
                                                    <td style="text-align:center; width:80px;">'.get_payments($rowStudent['status']).'</td>
                                                    <td style="text-align:right; width:80px;">'.number_format(round($remainingAmount)).'</td>
                                                    <td style="text-align:right; width:100px;"></td>
                                                </tr>';
                                                $grandTotal = ($grandTotal + $totalAmount);
                                                $grandPaid = $grandPaid + $paidAmount;
                                                $grandPending = $grandPending + $remainingAmount;
                                            }
                                        }
                                        echo '
                                        <tr>
                                            <td colspan="5" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Grand Total</td>
                                            <td style="text-align:right; font-size:12px; font-weight:bold;  border:1px solid #333;">'.number_format($grandPending).'</td>
                                            <td style="text-align:right; font-size:12px; font-weight:bold;  border:1px solid #333;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="page-break"></div>';
                    }
                }
            }

            // For Summary
            elseif($_GET['type'] == '2'){
                //  class
                if(isset($_GET['id_class2']) && !empty($_GET['id_class2'])){
                    $sql1 = "AND class_id IN (".$_GET['id_class2'].")";
                    $classComma = $_GET['id_class2'];
                    $class = explode(", ",$_GET['id_class2']);
                }
                //  gender
                if($_GET['std_gender']){
                    $sql2 = "AND st.std_gender = '".$_GET['std_gender']."'";
                    $std_gender = $_GET['std_gender'];
                }
                //Challan Types
                if(isset($_GET['chltyp']) && !empty($_GET['chltyp'])){
                    $sql3 = "AND f.id_type = '".$_GET['chltyp']."'";
                    $challanName = get_challantype($_GET['chltyp']);
                }
                //	is_hostelized
                if($_GET['is_hostelized']){
                    if($_GET['is_hostelized']==1){
                        $sql4 = "AND st.is_hostelized = '1'";
                        $is_hostelized = get_studenttype($_GET['is_hostelized']);
                    }else{
                        $sql4 = "AND st.is_hostelized != '1'";
                        $is_hostelized = get_studenttype($_GET['is_hostelized']);
                    }
                }
                foreach ($classgroup as $group):
                    $sr = 0;
                    
                    $totalstudents      = 0;
                    $totalpayable       = 0; 
                    $totalpaid          = 0;
                    $totalpending       = 0;

                    $sqllmsClass = $dblms->querylms("SELECT class_id, class_name, id_classgroup
                                                            FROM ".CLASSES."			   
                                                            WHERE class_id     != '' 
                                                            AND class_status    = '1' 
                                                            AND is_deleted      = '0' $sql1
                                                            AND id_classgroup   = '".cleanvars($group['id'])."'
                                                            ORDER BY class_id ASC");
                    if(mysqli_num_rows($sqllmsClass) > 0){
                        echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan="6"><h4>'.get_classgroup($group['id']).'</h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><h4 style="margin: 5px; color: red;">Defaulter List Summary ('.$challanName.' Challans'.(!empty($std_gender) ? ' - '.$std_gender.'': '').(!empty($is_hostelized) ? ' - '.$is_hostelized.'': '').')</h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><h4>'.date('l d M Y').'</h4></td>
                                        </tr>
                                        <tr>
                                            <th width="50">Sr #</th>
                                            <th>Class</th>
                                            <th width="100">Active Students</th>
                                            <th width="100" style="text-align:center; font-size:12px; font-weight:bold;">Pending</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        while($rowClass = mysqli_fetch_array($sqllmsClass)){
                                            $sr++;
                                            $sqllmsFeeDefaulter	= $dblms->querylms("SELECT f.status, GROUP_CONCAT(f.challan_no SEPARATOR ', ') challans, COUNT(DISTINCT f.id_std) totalstudents,
                                                                                    SUM(
                                                                                        (case when f.due_date > '".date('Y-m-d')."' then f.total_amount
                                                                                        else f.total_amount + '".LATEFEE."'
                                                                                        end)
                                                                                    ) as totalamount,
                                                                                    SUM(f.paid_amount) paidamount
                                                                                    FROM ".FEES." f				   
                                                                                    INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
                                                                                    WHERE (f.status = '2' OR f.status = '4') 
                                                                                    AND f.id_class      = ".$rowClass['class_id']." $sql2 $sql3 $sql4 
                                                                                    AND f.is_deleted   != '1' 
                                                                                    AND st.is_deleted  != '1'
                                                                                    AND f.id_campus     = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
                                                                                    AND st.std_status   = '1' ");
                                            
                                            if(mysqli_num_rows($sqllmsFeeDefaulter) > 0) {
                                                
                                                $rowStudent = mysqli_fetch_array($sqllmsFeeDefaulter);
                                                // Online Payment
                                                // $sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
                                                //                                     FROM ".PAY_API_TRAN."
                                                //                                     WHERE challan_no IN (".$rowStudent['challans'].")");

                                                // $onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
                                                
                                                $payable        = $rowStudent['totalamount'];
                                                $paid           = $rowStudent['paidamount'];
                                                $pending        = $payable - $paid;
                                                echo '
                                                <tr>
                                                    <td style="text-align: center;">'.$sr.'</td>
                                                    <td>'.$rowClass['class_name'].'</td>
                                                    <td style="text-align: center;">'.number_format($rowStudent['totalstudents']).'</td>
                                                    <td style="text-align: right;">'.number_format($pending).'</td>
                                                </tr>';
                                            }
                                            $totalstudents     = $totalstudents + $rowStudent['totalstudents'];
                                            $totalpayable      = $totalpayable + $payable;
                                            $totalpaid         = $totalpaid + $paid;
                                            $totalpending      = $totalpending + $pending;
                                        }
                                        echo'
                                        <tr>
                                            <td colspan="2" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Grand Totals</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalstudents).'</td>
                                            <td style="text-align:right; font-size:12px; font-weight:bold; border:1px solid #333;">'.number_format($totalpending).'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="page-break"></div>';
                    }

                endforeach;
            }
            else{
                echo'<h2 style="text-align: center; color: red; margin-top: 50px;">No Record Found</h2>';
            }
			echo '
			<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
			<span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>
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