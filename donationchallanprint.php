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
<title>Donation Challan Form</title>
<style type="text/css">
body {overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri, "Calibri Light";  }
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 landscape;
	   margin: 4mm 4mm 4mm 4mm; 
	}
}
h1 { text-align:left; margin:0; margin-top:0; margin-bottom:0px; font-size:26px; font-weight:700; text-transform:uppercase; }
.spanh1 { font-size:14px; font-weight:normal; text-transform:none; text-align:right; float:right; margin-top:0px; }
h2 { text-align:left; margin:0; margin-top:0; margin-bottom:1px; font-size:22px; font-weight:700; text-transform:uppercase; }
.spanh2 { font-size:20px; font-weight:700; text-transform:none; }
h3 { text-align:center; margin:0; margin-top:0; margin-bottom:1px; font-size:19px; font-weight:700; text-transform:uppercase; padding: 0px; }
h4 { 
	text-align:center; margin:0; margin-bottom:1px; font-weight:normal; font-size:13px; font-weight:700; word-spacing:0.1em;  
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
//Single Challan Print
//--------------------------------------
if(isset($_GET['id'])) {
echo '
<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
<tr>';
//----------------------------------------
	$sqllms  = $dblms->querylms("SELECT f.id, f.status, f.challan_no, f.id_month, f.issue_date, f.due_date, f.paid_date, f.total_amount, f.remaining_amount, d.donor_name
										FROM ".FEES." f		   
								        INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor 
										WHERE f.challan_no = '".cleanvars($_GET['id'])."' LIMIT 1");

	$valDonation = mysqli_fetch_array($sqllms); 
//----------------------------------------
	if($valDonation['status'] == 1) { 
		$clspaid = " paid";
	} else { 
		$clspaid = "";
	}
//----------------------------------------
	$cpi = 0;
//------------------------------------------
for($ifee = 1; $ifee<=3; $ifee++) { 
	if($ifee<3) { 
		$rightborder = 'style="border-right:1px dashed #333;"';
	} else { 
		$rightborder = '';
	}
	$cpi++;
//------------------------------------------
	if($cpi==1) { 
		$copyfor = 'Bank';
	} else if($cpi==2) { 
		$copyfor = 'Account';
	}else if($cpi==3) { 
		$copyfor = "Donor";
	}

	$stdname = preg_replace('/\s+/', ' ', $valDonation['donor_name']);
	$shortarray = explode(' ',trim($stdname));
	$firstname 	= $shortarray[0];
	$displayname =  $valDonation['donor_name'];
echo '
	<td width="341"  '.$rightborder.' class="'.$clspaid.'">
		<h3>
			<img src="uploads/logo.png" style="width:50px; height: 50px; text-align: left; vertical-align: middle;">
			<span>Aghosh Grammar School</span>
		</h3>
		<h6 style="margin-top: -16px;"> <span class="spanh1">'.$copyfor.'</span></h6>
		<!-- <h4 style="margin-top: 0px;">ABL Collection Account # 0762-0010027282250031</h4> -->
<div class="line1"></div>
<div style="font-size:13px; margin-top:5px;">
<table style="border-collapse:collapse;" width="100%" border="0">
<tr>
	<td style="text-align:left; width:75px;">Challan #:</td>
	<td style= text-align:left; width:150px;"><span style="width:90px;display:inline-block; overflow:hidden; border-bottom:1px solid;">'.$valDonation['challan_no'].'</span></td>
	<td style="text-align:left;width:70px;">Issue Date:</td>
	<td style="text-align:left; text-decoration:underline;">'.$valDonation['issue_date'].'</td>
</tr>
<tr>
	<td style="text-align:left;">Month :</td>
	<td style="text-align:left; text-decoration:underline;"><u>'.get_monthtypes($valDonation['id_month']).'</span></td>
	<td style="text-align:left;">Due Date:</td>
	<td style=" text-align:left; text-decoration:underline;">'.$valDonation['due_date'].'</td>	
</tr>
<tr>
	<td style="text-align:left;">Donar:</td>
	<td  style=" text-decoration:underline;"><span style="font-size:12px;">'.$displayname.'</span></td>
</tr>
<tr>
</tr>
</table>
</div>
<div style="font-size:12px; margin-top:5px;">
<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="2" cellspacing="2" border="1" width="100%">
<tr>
	<td style="text-align:center; font-size:12px; font-weight:bold; width:6%;">Sr</td>
	<td style="text-align:left; font-size:12px; font-weight:bold;">Student</td>
	<td style="text-align:left; font-size:12px; font-weight:bold;">Class</td>
	<td style="text-align:left; font-size:12px; font-weight:bold;">Roll No.</td>
	<td style="text-align:right; font-size:12px; font-weight:bold;">Amount</td>
</tr>';
//------------------------------------------------
	$sqllmsDonDet  = $dblms->querylms("SELECT d.amount, s.std_name, s.std_rollno, c.class_name
										FROM ".DONATION_DETAILS." d
								        INNER JOIN ".STUDENTS." s ON s.std_id 	= d.id_std 
								        INNER JOIN ".CLASSES."  c ON c.class_id = s.id_class 
                                        WHERE d.id_donation = '".cleanvars($valDonation['id'])."'
										ORDER BY s.std_name ASC");
	//--------------------------------------
	if(mysqli_num_rows($sqllmsDonDet) > 0) {
	    $srno = 0;
		while($valDetail 	= mysqli_fetch_array($sqllmsDonDet)) {
		//--------------------------------------
			$srno++;
			//--------------------------------------
			echo '
			<tr>
				<td style="text-align:center;">'.$srno.'</td>
				<td>'.$valDetail['std_name'].'</td>
				<td>'.$valDetail['class_name'].'</td>
				<td>'.$valDetail['std_rollno'].'</td>
				<td style="text-align:right;">'.number_format($valDetail['amount']).'</td>
			</tr>';
		//--------------------------------------
		}
	//--------------------------------------
	}
//------------------------------------------------
echo '
<tr>
	<td style="text-align:left; font-size:12px; font-weight:bold; border:2px solid #333;" colspan="4">Grand Total</td>
	<td style="text-align:right; font-size:12px; font-weight:bold;  border:2px solid #333;">'.number_format($valDonation['total_amount']).'</td>
</tr>
</table>';
	if($_SESSION['userlogininfo']['LOGINAFOR'] != 3) { 
	echo '<span style="font-size:9px;">issue by: '.cleanvars($_SESSION['userlogininfo']['LOGINNAME']).'</span>';
	}
echo '
<span style="font-size:9px; float:right; margin-top:3px;">issue Date: '.date("m/d/Y").'</span>
</div>

<div style="clear:both;"></div>
<div style="font-size:13px; color:#000; margin-top:10px;">
<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="5">
	<tr>
		<td style="font-weight:normal; font-style:italic; text-align:left; font-size:11px; width:80%;">Rupees in word: <span style="text-decoration:underline; font-size:9px; color:#000;">'.convert_number_to_words($valDonation['total_amount']).' only</span>
		</td>
		<td style="font-weight:normal; font-style:italic; text-align:right;">Cashier</td>
	</tr>
</table>
</div>
	</td>';
}
echo '</tr>
</table>';
}
//--------------------------------------
//End Single Challan Print

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