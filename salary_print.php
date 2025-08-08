<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
	//-----------------------------------------------
	if($_SESSION['userlogininfo']['LOGINAFOR'] == 2){
	//-----------------------------------------------
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
	<title>Employee Salary Report</title>
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
//--------------SALARY REPORT START---------------
if(isset($_GET['month'])) {
	//-----------------------------------------------------
	$sqllmspayslip	= $dblms->querylms("SELECT s.id, s.slip_no, s.month, s.basic_salary, s.total_allowances, s.total_deductions, s.net_pay, s.dated,
											e.emply_name, e.emply_joindate, e.emply_phone, e.emply_email, d.dept_name, dp.designation_name
											FROM ".SALARY." s
											INNER JOIN ".EMPLOYEES." e ON e.emply_id = s.id_emply
											LEFT JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
											LEFT JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
											WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
											AND s.dated LIKE '".$_GET['month']."-%'
											AND s.status = '1' ");
	//------------------------------------------------------
	if(mysqli_num_rows($sqllmspayslip) > 0){
	//------------------------------------------------------
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top" '.$rightborder.' class="'.$clspaid.'">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				Laural Home School <span style="font-size: 14px;">('.$value_campus['campus_name'].')</span>
			</h2>
			<h4>Employees Salary Report <u>'.date('M Y' , strtotime(cleanvars($_GET['month']))).'</u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Sr #</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Name</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Designation</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Basic Pay</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Allowance</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Deduction</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Net Salary</td>
	</tr>';
	//------------------------------------------------
	$srno = 0;
	$total_basic = 0;
	$total_allowance = 0;
	$totla_deduction = 0;
	$total_net = 0;
	while($value_pay = mysqli_fetch_array($sqllmspayslip)) {
	$srno++;
	//------------------------------------------------
	echo '
	<tr>
		<td style="text-align: center;">'.$srno.'</td>
		<td>'.$value_pay['emply_name'].'</td>
		<td>'.$value_pay['designation_name'].'</td>
		<td>'.$value_pay['basic_salary'].'</td>
		<td>'.$value_pay['total_allowances'].'</td>
		<td>'.$value_pay['total_deductions'].'</td>
		<td>'.number_format($value_pay['net_pay']).'</td>
	</tr>';
	$total_basic = $total_basic + $value_pay['basic_salary'];
	$total_allowance = $total_allowance + $value_pay['total_allowances'];
	$totla_deduction = $totla_deduction + $value_pay['total_deductions'];
	$total_net = $total_net + $value_pay['net_pay'];
	}
	echo'
	<tr style="font-size:12px; font-weight:bold;  border:2px solid #333;">
		<th colspan="3" style="text-align: center;">Totals</th>
		<td>'.number_format($total_basic).'</td>
		<td>'.number_format($total_allowance).'</td>
		<td>'.number_format($totla_deduction).'</td>
		<td>'.number_format($total_net).'</td>
	</tr>
	</table>
	</div>';
	}
	echo'

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
		';
}
//--------------SALARY REPORT END-----------------



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
}
else{
    header("Location: dashboard.php");
}
?>