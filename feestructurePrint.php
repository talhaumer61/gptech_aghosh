<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------
$sqllmscampus  = $dblms->querylms("SELECT * 
									FROM ".CAMPUS." 
									WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);
//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Fee Structure Print</title>
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
//--------------------------------------
if(isset($_GET['id'])) {
	$sql2 = "AND f.id = '".cleanvars($_GET['id'])."' LIMIT 1";
}else{
	$sql2 = "ORDER BY f.id DESC";
}
//----------------------------------------
$sqllms	= $dblms->querylms("SELECT f.id, f.status, f.dated, f.id_class, f.id_section, f.id_session,
								   c.class_name, cs.section_name, s.session_name
								   FROM ".FEESETUP." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session
								   WHERE f.is_deleted != '1'
								   AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   $sql2 ");
//----------------------------------------
echo'
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
				<h2 style="text-align: center;">
					<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;"> 
					<span style="">Aghosh Grammar School</span>
				</h2>';
			while($feeStructure = mysqli_fetch_array($sqllms)) {
				//----------------------------------------
				echo'
				<div class="row" style="margin-top: 15px;">
					<h4>Fee Structre of '.$feeStructure['class_name'].' ';
						if($feeStructure['section_name']){
							echo'('.$feeStructure['section_name'].')';
						}
						echo'
					</h4>
					<h4 class="center">Session: '.$feeStructure['session_name'].'</h4>
				</div>
				<div class="line1"></div>
					<div style="font-size:12px; margin-top:10px;">
						<h4>Particulars</h4>
						<table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
							<thead>
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Head</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">At Admission</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Monthly Fee</td>
								</tr>
							</thead>
							<tbody>';
								$atAdmission = 0;
								$mothlyFee = 0; 
								//-----------------------------------------------------
								$sqlCats	= $dblms->querylms("SELECT c.cat_id, c.cat_name
																FROM ".FEE_CATEGORY." c												 
																WHERE c.cat_status = '1' AND is_deleted != '1' 
																ORDER BY c.cat_ordering ASC");
								$srno = 0;
								//-----------------------------------------------------
								while($rowsvalues = mysqli_fetch_array($sqlCats)) {
								//-----------------------------------------------------
								$srno++;
								//-----------------------------------------------------
								$sqllmsfeedetail	= $dblms->querylms("SELECT fsd.id, fsd.duration, fsd.amount, fsd.type
																FROM ".FEE_CATEGORY." c
																INNER JOIN ".FEESETUPDETAIL." fsd ON fsd.id_cat = c.cat_id 													 
																WHERE c.is_deleted != '1' 
																AND fsd.id_setup = '".cleanvars($feeStructure['id'])."' AND fsd.id_cat = '".$rowsvalues['cat_id']."'
																LIMIT 1");
								$value_detail = mysqli_fetch_array($sqllmsfeedetail);
								//-----------------------------------------------------
								echo '
								<tr>
									<td style="padding-left: 5px;">'.$rowsvalues['cat_name'].'</td>
									<td style="text-align:center; width: 150px;">';
										if($value_detail['duration'] != "Monthly"){

											echo' '.$value_detail['amount'].' ';
											$atAdmission = $atAdmission + $value_detail['amount'];

										}else{
											echo"---";
										}
										echo'
									</td> 
									<td style="text-align:center; width: 150px;">';
										if($value_detail['duration'] == "Monthly"){

											echo' '.$value_detail['amount'].' ';
											$mothlyFee = $mothlyFee + $value_detail['amount'];

										}else{
											echo"---";
										}
										echo'
									</td>
								</tr>';
								//-----------------------------------------------------
								}
								//-----------------------------------------------------
								echo '
							</tbody>
							<tr>
								<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Grand Total</td>
								<td style="text-align:center; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($atAdmission).'</td>
								<td style="text-align:center; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($mothlyFee).'</td>
							</tr>
						</table>
						<table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="5" border="1" width="100%">
							<tr>
								<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Total Payable At the Time of Admission</td>
								<td style="text-align:center; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($atAdmission + $mothlyFee).'</td>
							</tr>
						</table>
						<table style="border-collapse:collapse; margin-top:10px;" cellpadding="8" border="1" width="100%">
								<td style="text-align:center; font-size:12px; font-weight:bold; border:2px solid #333;">Note: At the time of Admission Monthly/Quartely Fee will be in Included</td>
						</table>
					</div>
				</div>';
			}
			echo'
			<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>
			<span style="font-size:9px; float:right; margin-top:3px;">issue Date: '.date("m/d/Y").'</span>
		</td>
	</tr>
</table>';
//--------------------------------------
echo'<div class="page-break"></div>';
//--------------------------------------

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