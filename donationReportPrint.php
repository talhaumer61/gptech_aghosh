<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();

//------------------------------------------------
if(isset($_GET['cls']) && $_GET['cls'] != 'all' && $_GET['cls'] != '') {
    $sql2 = "AND class_id = '".cleanvars($_GET['cls'])."'";
}
else{
    $sql2 = "";
}
//------------------------------------------------
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
                <span style="">Aghosh Grammar School</span>
            </h2>';

                if($_GET['id_month'] > 0){
                    $month = $_GET['id_month'];
                    $monthSQL = "AND f.id_month = '".$_GET['id_month']."'";
                }else{
                    $month = "";
                    $monthSQL = "";
                }
                    
                $sr = 0; 
                $grandTotalAmount = 0;

                $sqllmsDonation	= $dblms->querylms("SELECT f.status, f.challan_no, f.id_month, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount, d.donor_name
											FROM ".FEES." f			   
											INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor 	
											WHERE f.id != '' AND f.id_type = '3' $monthSQL
											AND f.is_deleted != '1' ORDER BY d.donor_name");
                
                    if(mysqli_num_rows($sqllmsDonation) > 0) {
                        //----------------------------------------
                        echo'
                            <div style="font-size:12px; margin-top:10px;">
                                <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan="7"><h4 style="margin-top: 10px; color: red;">Donation Report';  if($_GET['id_month'] > 0){echo " of ".get_monthtypes($month);} echo'</h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><h4>'.date('l d M Y').'</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center; font-size:12px; font-weight:bold; width: 15px;">Sr #</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Name of Donor</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Challan Month</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Challan #</td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Amount </td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Status </td>
                                            <td style="text-align:center; font-size:12px; font-weight:bold;">Reamrks </td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        //-----------------------------------------------------
                                        while($valDonation = mysqli_fetch_array($sqllmsDonation)) {
                                            $sr++;
                                            echo '
                                            <tr>
                                                <td style="text-align:center;">'.$sr.'</td>
                                                <td style="width:100px;">'.$valDonation['donor_name'].'</td> 
                                                <td style="width:80px;">'.get_monthtypes($valDonation['id_month']).'</td>
                                                <td style="width:80px;">'.$valDonation['challan_no'].'</td>
                                                <td style="text-align:right; width:80px;">'.number_format(round($valDonation['total_amount'])).'</td>
                                                <td style="text-align:center; width:20px;">'.get_payments1($valDonation['status']).'</td>
                                                <td style="width:100px;"></td>
                                            </tr>';
                                            $grandTotalAmount = $grandTotalAmount + $valDonation['total_amount'];
                                        }
                                        echo'
                                        <tr>
                                            <td colspan="4" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Grand Totals</td>
                                            <td style="text-align:right; font-size:12px; font-weight:bold;  border:1px solid #333;">'.number_format($grandTotalAmount).'</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
                    } else{
                        echo'<h2 style="text-align: center; color: red; margin-top: 50px;">No Record Found</h2>';
                    }




			echo '
			<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
			<span style="font-size:9px; float:right; margin-top:3px;">Print Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>';

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