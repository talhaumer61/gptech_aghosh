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
<meta charset="utf-8">';

if(isset($_GET['incexp_from']) && isset($_GET['incexp_to'])) {
	echo'<title>Income Expense Report</title>';
}elseif(isset($_GET['con_trailbal_from']) && isset($_GET['con_trailbal_to'])) {
	echo'<title>Concise Trial Balance Sheet</title>';
}elseif(isset($_GET['comp_trailbal_from']) && isset($_GET['comp_trailbal_to'])) {
	echo'<title>Comprehensive Trial Balance Sheet</title>';
}else{echo'';}
echo'
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
//--------------INCOME EXPENSE PRINT START---------------
if(isset($_GET['incexp_from']) && isset($_GET['incexp_to'])) {
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>';
	//----------------------------INCOME START-------------------------
	$sqllms_inc	= $dblms->querylms("SELECT t.trans_title, t.trans_amount, h.head_name
									FROM ".ACCOUNT_TRANS." t
									INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
									WHERE t.trans_status= '1' AND t.trans_type = '1' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($_GET['incexp_from'])))."' AND '".date('Y-m-d' , strtotime(cleanvars($_GET['incexp_to'])))."')
									ORDER BY t.trans_id DESC");
	//--------------------------income end---------------------------
	//----------------------------Expense Start-------------------------
	$sqllms_exp	= $dblms->querylms("SELECT t.trans_id, t.trans_title, t.trans_amount, t.voucher_no, t.trans_method, t.dated,  h.head_name
									FROM ".ACCOUNT_TRANS." t
									INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
									WHERE t.trans_status= '1' AND t.trans_type = '2' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
									AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($_GET['incexp_from'])))."' AND '".date('Y-m-d' , strtotime(cleanvars($_GET['incexp_to'])))."') 
									ORDER BY t.trans_id DESC");
	//----------------------------Expense end-------------------------
		if($feercord['status'] == 1) { 
			$clspaid = " paid";
		} else { 
			$clspaid = "";
		}
	//----------------------------------------
		$cpi = 0;
	//------------------------------------------
		$stdname = preg_replace('/\s+/', ' ', $feercord['std_name']);
		$shortarray = explode(' ',trim($stdname));
		$firstname 	= $shortarray[0];
		$displayname =  $feercord['std_name'];
	echo '
		<td width="341" valign="top" '.$rightborder.' class="'.$clspaid.'">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				Laural Home School <span style="font-size: 14px;">('.$value_campus['campus_name'].')</span>
			</h2>
			<h4>Income & Expense Report from <u>'.$_GET['incexp_from'].'</u> to <u>'.$_GET['incexp_to'].'</u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<!-- Income -->
	<h3>Income </h3>
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Detail</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;">Amount</td>
	</tr>';
	$total_income = 0;
	//--------------------------------------
			while($values_inc = mysqli_fetch_array($sqllms_inc)) {
				echo '
				<tr>
					<td>'.$values_inc['trans_title'].' ('.$values_inc['head_name'].')</td>
					<td style="text-align:right; width:45%;">'.number_format($values_inc['trans_amount']).'</td>
				</tr>';
				$total_income = $total_income + $values_inc['trans_amount'];
			//--------------------------------------
			}
	//------------------------------------------------
	echo '
	<tr>
		<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">Total Income</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($total_income).'</td>
	</tr>
	</table>
	</div>

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">

	<!-- Expense -->
	<h3>Expense </h3>
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Detail</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;">Amount</td>
	</tr>';
	$total_expense = 0;
	//--------------------------------------
			while($values_exp = mysqli_fetch_array($sqllms_exp)) {
				echo '
				<tr>
					<td>'.$values_exp['trans_title'].' ('.$values_exp['head_name'].')</td>
					<td style="text-align:right; width:45%;">'.number_format($values_exp['trans_amount']).'</td>
				</tr>';
				$total_expense = $total_expense + $values_exp['trans_amount'];
			//--------------------------------------
			}
	//------------------------------------------------
	echo '
	<tr>
		<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">Total Expense</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($total_expense).'</td>
	</tr>
	</table>
	</div>
		</td>';
	echo '</tr>
	</table>';

			if($total_income > $total_expense){
				$ans = $total_income - $total_expense;
				echo'<p style="text-align:right; padding: 20px;"><b style="font-size: 15px;">Profit: <span style="font-size: 20px;">'.number_format( $ans).'</span> Rs</b></p>';
			}else{
				$ans = $total_expense - $total_income;
				echo'<p style="text-align:right; padding: 20px;"><b style="font-size: 15px; ">Loss: <span style="font-size: 20px;">'.number_format( $ans).'</span> Rs</b></p>';
			}
			
	//-------------------PRINT DETAILS------------------------
			if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
			echo '<span style="font-size:9px; padding: 20px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
			}
		echo '
		<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="10" cellspacing="5">
		
			<span style="font-size:9px; float:right; margin-top:3px; padding: 20px;">issue Date: '.date("m/d/Y").'</span>
			</div>
			
			<div style="clear:both;"></div>
			<div style="font-size:13px; color:#000; margin-top:20px;">
		</table>
		';
}
//--------------INCOME EXPENSE PRINT END-----------------

//--------------CONCISE TRAIL BALANCE PRINT START---------------
if(isset($_GET['con_trailbal_from']) && isset($_GET['con_trailbal_to'])) {
	//-----------------------GET HEADS------------------------------
	$sqllms_head	= $dblms->querylms("SELECT head_id, head_name
											FROM ".ACCOUNT_HEADS."
											WHERE head_status= '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
											ORDER BY head_id ASC");
	//------------------------------------------------------
	if(mysqli_num_rows($sqllms_head) > 0){
	//------------------------------------------------------
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>';
		$cpi = 0;
	//----------------------------------------
	echo '
		<td width="341" valign="top" '.$rightborder.' class="'.$clspaid.'">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				Laural Home School <span style="font-size: 14px;">('.$value_campus['campus_name'].')</span>
			</h2>
			<h4>Concise Trail Balance Sheet from <u>'.$_GET['con_trailbal_from'].'</u> to <u>'.$_GET['con_trailbal_to'].'</u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Particulars</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Debit</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Credit</td>
	</tr>';
			//--------------------------------------
			$debit = 0;
			$credit = 0;
			//-----------------------------------------------------
			while($values_heads = mysqli_fetch_array($sqllms_head)){
			//----------------------------TRANSACTIONS START-------------------------
			$sqllms_inc	= $dblms->querylms("SELECT trans_title, SUM(trans_amount) as amount, trans_type
											FROM ".ACCOUNT_TRANS." 
											WHERE trans_status= '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' AND id_head = '".$values_heads['head_id']."'
											AND (dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($_GET['con_trailbal_from'])))."' AND '".date('Y-m-d' , strtotime(cleanvars($_GET['con_trailbal_to'])))."')
											ORDER BY trans_id DESC");
			//--------------------------TRANSACTIONS END---------------------------
            //-----------------------------------------------------
            if(mysqli_num_rows($sqllms_inc) > 0){
			//-----------------------------------------------------
			$values_inc = mysqli_fetch_array($sqllms_inc);
				echo '
				<tr>
					<td style="text-align: left; width:45%;">';
						if($values_inc['trans_type'] == '1'){
							echo'Recivable: '.$values_heads['head_name'].' ';
						}
						elseif($values_inc['trans_type'] == '2'){
							echo'Payable: '.$values_heads['head_name'].' ';
						}
					echo'
					</td>';
					if($values_inc['trans_type'] == '1'){
						echo'
						<td style="text-align:right; width:25%;">
							<b>'.number_format($values_inc['amount']).'</b>
						</td>
						<td style="text-align:right; width:25%;">0</td>';
						$debit = $debit + $values_inc['amount'];
					}
					elseif($values_inc['trans_type'] == '2'){
						echo'
						<td style="text-align:right; width:25%;">0</td>
						<td style="text-align:right; width:25%;">
							<b>'.number_format($values_inc['amount']).'</b>
						</td>';
						$credit = $credit + $values_inc['amount'];
						}
						else{
							echo'<td></td>';
						}
						echo'
					</td>
				</tr>';
			//--------------------------------------
			}}
	//------------------------------------------------
	echo '
	<tr>
		<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">Totals</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($debit).' Rs</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($credit).' Rs</td>
	</tr>
	</tr>
	</table>';
	}
	echo'
	</div>

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">';
			
	//-------------------PRINT DETAILS------------------------
			if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
			echo '<span style="font-size:9px; padding: 20px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
			}
		echo '
		<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="10" cellspacing="5">
		
			<span style="font-size:9px; float:right; margin-top:3px; padding: 20px;">issue Date: '.date("m/d/Y").'</span>
			</div>
			
			<div style="clear:both;"></div>
			<div style="font-size:13px; color:#000; margin-top:20px;">
		</table>
		';
}
//--------------CONCISE TRAIL BALANCE PRINT END-----------------

//--------------COMPREHENSIVE TRAIL BALANCE PRINT START---------------
if(isset($_GET['comp_trailbal_from']) && isset($_GET['comp_trailbal_to'])) {
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>';
	//----------------------------TRANSACTIONS START-------------------------
	$sqllms_inc	= $dblms->querylms("SELECT t.trans_title, t.trans_amount, t.trans_type, h.head_name
									FROM ".ACCOUNT_TRANS." t
									INNER JOIN ".ACCOUNT_HEADS." h ON h.head_id = t.id_head
									WHERE t.trans_status= '1' AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND (t.dated BETWEEN '".date('Y-m-d' , strtotime(cleanvars($_GET['comp_trailbal_from'])))."' AND '".date('Y-m-d' , strtotime(cleanvars($_GET['comp_trailbal_to'])))."')
									ORDER BY t.trans_id DESC");
	//--------------------------TRANSACTIONS END---------------------------
		if($feercord['status'] == 1) { 
			$clspaid = " paid";
		} else { 
			$clspaid = "";
		}
	//----------------------------------------
		$cpi = 0;
	//------------------------------------------
	echo '
		<td width="341" valign="top" '.$rightborder.' class="'.$clspaid.'">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				Laural Home School <span style="font-size: 14px;">('.$value_campus['campus_name'].')</span>
			</h2>
			<h4>Comprehensive Trail Balance Sheet from <u>'.$_GET['comp_trailbal_from'].'</u> to <u>'.$_GET['comp_trailbal_to'].'</u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Particulars</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Debit</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Credit</td>
	</tr>';
	$debit = 0;
	$credit = 0;
	//--------------------------------------
			while($values_inc = mysqli_fetch_array($sqllms_inc)) {
				echo '
				<tr>
					<td style="text-align: left; width:45%;">';
						if($values_inc['trans_type'] == '1'){
							echo'Recivable: '.$values_inc['trans_title'].' ';
						}
						elseif($values_inc['trans_type'] == '2'){
							echo'Payable: '.$values_inc['trans_title'].' ';
						}
					echo'
					</td>';
					if($values_inc['trans_type'] == '1'){
						echo'
						<td style="text-align:right; width:25%;">
							<b>'.number_format($values_inc['trans_amount']).'</b>
						</td>
						<td style="text-align:right; width:25%;">0</td>';
						$debit = $debit + $values_inc['trans_amount'];
					}
					elseif($values_inc['trans_type'] == '2'){
						echo'
						<td style="text-align:right; width:25%;">0</td>
						<td style="text-align:right; width:25%;">
							<b>'.number_format($values_inc['trans_amount']).'</b>
						</td>';
						$credit = $credit + $values_inc['trans_amount'];
						}
						else{
							echo'<td></td>';
						}
						echo'
					</td>
				</tr>';
			//--------------------------------------
			}
	//------------------------------------------------
	echo '
	<tr>
		<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;">Totals</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($debit).' Rs</td>
		<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($credit).' Rs</td>
	</tr>
	</table>
	</div>

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">';
			
	//-------------------PRINT DETAILS------------------------
			if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
			echo '<span style="font-size:9px; padding: 20px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
			}
		echo '
		<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="10" cellspacing="5">
		
			<span style="font-size:9px; float:right; margin-top:3px; padding: 20px;">issue Date: '.date("m/d/Y").'</span>
			</div>
			
			<div style="clear:both;"></div>
			<div style="font-size:13px; color:#000; margin-top:20px;">
		</table>
		';
}
//--------------COMPREHENSIVE TRAIL BALANCE PRINT END-----------------



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