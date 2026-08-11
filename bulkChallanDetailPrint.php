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
	
	$id_month = date('m', strtotime($_GET['yearmonth']));
	
	$sqllmscampus  = $dblms->querylms("SELECT * 
										FROM ".CAMPUS." 
										WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
	$value_campus = mysqli_fetch_array($sqllmscampus);
//------------------------------------------------
	if(isset($_GET['id_class'])){
		$sqllmsCls	= $dblms->querylms("SELECT class_name
										FROM ".CLASSES."
										WHERE class_id != '' AND class_status = '1' AND class_id = '".$_GET['id_class']."' ");
		$valueCls = mysqli_fetch_array($sqllmsCls);
	}
//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>'.SCHOOL_SHORT.' '.$valueCls['class_name'].' Challans List of Month  '.get_monthtypes($id_month).'</title>
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
//-----------------------------------------------------

$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status, s.std_name, s.id_session,  s.std_fathername, s.std_rollno, c.class_name,
                                   f.id, f.challan_no, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.total_amount
								   FROM ".STUDENTS." s
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   INNER JOIN ".FEES." f ON f.id_std = s.std_id
								   WHERE s.std_id != '' AND f.is_deleted != '1'
								   AND f.id_month = '".$id_month."'
                                   AND f.id_class = '".$_GET['id_class']."'
								   AND f.status != '1'
                                   AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                   AND f.id_session = '".$_SESSION['userlogininfo']['ACADEMICSESSION']."'
								   ORDER BY s.std_id DESC");
//-----------------------------------------------------
if(mysqli_num_rows($sqllms) > 0){
	echo '
	<table width="99%" border="0" class="page " cellpadding="10" cellspacing="15" align="center" style="border-collapse:collapse; margin-top:0px;">
	<tr>
		<td width="341" valign="top">
			<div class="row">
			<h2>
				<img src="uploads/logo.png" class="img-fluid" style="width: 50px; height: 50px;">
				'.SCHOOL_NAME.' <span style="font-size: 14px;"></span>
			</h2>
			<h4> Challans List of Class '.$valueCls['class_name'].' for Month '.get_monthtypes($id_month).' </u></h4>
			</div>
	<div class="line1"></div>
	<div style="font-size:12px; margin-top:5px;">


	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">
	<table style="border-collapse:collapse; border:1px solid #666;" cellpadding="3" cellspacing="2" border="1" width="100%">
	<tr>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 50px;">Sr #</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Student Name</td>
		<td style="text-align:center; font-size:12px; font-weight:bold;">Father Name</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 100px;">Challan</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 150px;">Monthly Actual Fee</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 80px!important;">Concession</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 150px;">Current Month Fee</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 150px;">Previous Remaining</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 80px;">Fine</td>
		<td style="text-align:center; font-size:12px; font-weight:bold; width: 80px;">Total Payable</td>
	</tr>';
	//------------------------------------------------
	$srno = 0;
    $totalConcessionScholarship = 0;
    $totFine = 0;
    $totRemaining = 0;
    $totPayable = 0;

	//------------------------------------------------
	while($valueStudent = mysqli_fetch_array($sqllms)) {
        $srno++;
	 //Check Student Hostel Registration
                $sqllmHostelRegistration	= $dblms->querylms("SELECT id 
                                                                    FROM ".HOSTEL_REG."
                                                                    WHERE status = '1' AND id_std = '".$valueStudent['std_id']."'
                                                                    AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
                //If Hostelized Add Fee Cats
                if (mysqli_num_rows($sqllmHostelRegistration) == 1) {
                    $hostel_cats = ""; 
                }
                else{
                    $hostel_cats = ",6,7,8"; 
                }
		
	$sqllmsFee	= $dblms->querylms("SELECT SUM(fd.amount) as total_amount
										FROM ".FEESETUP." f
										INNER JOIN ".FEESETUPDETAIL." fd ON fd.id_setup = f.id
										WHERE  fd.id_cat NOT IN(1,4,5$hostel_cats)
										AND f.id_class = '".$_GET['id_class']."'
										AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
                                   		AND f.id_session = '".$valueStudent['id_session']."'
										LIMIT 1	");
	$valueFee = mysqli_fetch_array($sqllmsFee);
        //-------- Scholarship ---------------
		$sqllmsSch = $dblms->querylms("SELECT amount
										FROM ".FEE_PARTICULARS."
										WHERE id_fee = '".$valueStudent['id']."'
										AND id_cat = '17'");
		$valSchC = mysqli_fetch_array($sqllmsSch);

        //-------- Concession ---------------
		$sqllmsConcess = $dblms->querylms("SELECT SUM(concession) as totconcession
										FROM ".FEE_PARTICULARS."
										WHERE id_fee = '".$valueStudent['id']."' ");
		$valConcess = mysqli_fetch_array($sqllmsConcess);
        //------------------------------------------------

		//Totla Concession
		$totalConcession = $valSchC['amount'] + $valConcess['totconcession'];

        //------------------- Fine -----------------------
		$sqllmsFine = $dblms->querylms("SELECT amount
										FROM ".FEE_PARTICULARS."
										WHERE id_fee = '".$valueStudent['id']."'
										AND id_cat = '14'
										LIMIT 1 ");
		$valFine = mysqli_fetch_array($sqllmsFine);
        //------------------------------------------------

		//------------------- Previous Remaining Amount -----------------------
		$sqllmsPrevTotal = $dblms->querylms("SELECT amount
										FROM ".FEE_PARTICULARS."
										WHERE id_fee = '".$valueStudent['id']."'
										AND id_cat = '13'
										LIMIT 1 ");
		$valPrevTotal = mysqli_fetch_array($sqllmsPrevTotal);

		$total_amount = $valueStudent['total_amount'] - $valPrevTotal['amount'] - $valFine['amount'];
        //------------------------------------------------

        echo '
        <tr>
            <td style="text-align: center;">'.$srno.'</td>
            <td>'.$valueStudent['std_name'].'</td>
            <td>'.$valueStudent['std_fathername'].'</td>
            <td style="text-align: center;">'.$valueStudent['challan_no'].'</td>
            <td style="text-align: right;">'.number_format($valueFee['total_amount']).'</td> 
            <td style="text-align: right;">'.number_format($totalConcession).'</td>
            <td style="text-align: right;">'.number_format($total_amount).'</td> 
            <td style="text-align: right;">'.number_format($valPrevTotal['amount']).'</td>
            <td style="text-align: right;">'.number_format($valFine['amount']).'</td>
            <td style="text-align: right;">'.number_format($valueStudent['total_amount']).'</td>
        </tr>';
		$grandTotal = $grandTotal +  $total_amount;
        $totalConcessionScholarship = $totalConcessionScholarship + $totalConcession;
        $totRemaining = $totRemaining + $valPrevTotal['amount'];
        $totFine = $totFine + $valFine['amount'];
        $totPayable = $totPayable + $valueStudent['total_amount'];
	}
	echo'
    <tr style="font-size: 15px; border:2px solid #000;">
        <th colspan="5">Total</th>
        <th style="text-align: right;">'.number_format($grandTotal).'</th>
        <th style="text-align: right;">'.number_format($totalConcessionScholarship).'</th>
        <th style="text-align: right;">'.number_format($totRemaining).'</th>
        <th style="text-align: right;">'.number_format($totFine).'</th>
        <th style="text-align: right;">'.number_format($totPayable).'</th>
    </tr>
	</table>';
}
else{
    echo'<h3 style="color: red; text-align: center;">No Record Found!</h3>';
}

	echo'

	<div style="clear:both;"></div>
	<div style="font-size:13px; color:#000; margin-top:20px;">';
//------------ STUDENTS LIST END -----------------



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