<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------
if(isset($_GET['id'])) {

    //Donor Report
    $sqllmsDonor  = $dblms->querylms("SELECT donor_id, donor_name, donor_cnic, donor_phone, donor_whatsapp, donor_email, donor_address
                                            FROM ".DONORS."
                                            WHERE donor_id = '".cleanvars($_GET['id'])."'  
                                            LIMIT 1");
    $rowDonor = mysqli_fetch_array($sqllmsDonor);
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Donors Report Print</title>
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
            </h2>
            <h4>Donors Report</h4>
            <table style="border-collapse:collapse; margin-top:10px;" cellpadding="2" border="0" width="100%">
            <tbody>
                <tr>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">Name of Donor</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_name'].'</td>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">CNIC</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_cnic'].'</td>
                </tr>
                <tr>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">Contact #</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_phone'].'</td>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">Whatsapp</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_whatsapp'].'</td>
                </tr>
                <tr>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">Email</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_email'].'</td>
                    <td style="text-align:left; font-size:12px; font-weight:bold;">Address</td>
                    <td style="text-align:left; font-size:12px;">'.$rowDonor['donor_address'].'</td>
                </tr>
            </tbody>
        </table>';
            $sqllmsStudents	= $dblms->querylms("SELECT s.std_id, s.std_name, s.std_fathername, s.is_hostelized, c.class_name, d.amount, d.duration
                                                    FROM ".STUDENTS." s
                                                    INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
                                                    INNER JOIN ".DONATIONS_STUDENTS." d ON d.id_std = s.std_id
                                                    WHERE s.std_status = '1' AND s.is_deleted != '1' 
                                                    AND d.status = '1' AND d.is_deleted != '1' 
                                                    AND d.id_donor = '".$rowDonor['donor_id']."' ORDER BY s.std_name");
			if(mysqli_num_rows($sqllmsStudents) > 0) {
			//----------------------------------------
				echo'
					<div style="font-size:12px; margin-top:10px;">
						<h4>Students List</h4>
						<table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
							<thead>
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Sr #</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Name of Student</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Father Name</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Class</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Day S/Boarder</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Monthly Amount</td>
								</tr>
							</thead>
							<tbody>';
								$sr = 0; 
								$grandTotal = 0; 
								//-----------------------------------------------------
								while($rowStudent = mysqli_fetch_array($sqllmsStudents)) {
								//-----------------------------------------------------
                                    $sr++;
                                    $monthlyAmount = ($rowStudent['amount'] * $rowStudent['duration']);

                                    if($rowStudent['is_hostelized'] == 1){$dayScholarBoarder = 'Boarder';} else{$dayScholarBoarder = 'Day S';}
                                    echo '
                                    <tr>
                                        <td style="text-align:center; padding-left: 5px;width: 50px;">'.$sr.'</td>
                                        <td>'.$rowStudent['std_name'].'</td> 
                                        <td style="width: 150px;">'.$rowStudent['std_fathername'].'</td> 
                                        <td style="width: 100px;">'.$rowStudent['class_name'].'</td> 
                                        <td style="text-align:center; width: 100px;">'.$dayScholarBoarder.'</td>
                                        <td style="text-align:right; width: 80px;">'.$monthlyAmount.'</td>
                                    </tr>';
                                    $grandTotal = ($grandTotal + $monthlyAmount);
								//-----------------------------------------------------
								}
								//-----------------------------------------------------
								echo '
                                <tr>
                                    <td colspan="5" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Monthly Grand Total</td>
                                    <td style="text-align:right; font-size:12px; font-weight:bold;  border:1px solid #333;">'.number_format($grandTotal).'</td>
                                </tr>
							</tbody>
						</table>';
                        $sqllmsDonations = $dblms->querylms("SELECT status, id_month, total_amount 
                                                                    FROM ".FEES."
                                                                    WHERE id_donor = '".$rowDonor['donor_id']."' 
                                                                    AND is_deleted != '1'
                                                                    ORDER BY id_month LIMIT 20");
			            if(mysqli_num_rows($sqllmsDonations) > 0) {
                        echo '
                        <table style="border-collapse:collapse; border:1px solid #666; margin-top:10px;" cellpadding="2" border="1" width="100%">
							<thead>
								<tr>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Sr #</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Payment Month</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Amount</td>
									<td style="text-align:center; font-size:12px; font-weight:bold;">Status</td>
								</tr>
							</thead>
							<tbody>';
								$sr = 0; 
								$grandTotal = 0; 
								//-----------------------------------------------------
								while($rowDonation = mysqli_fetch_array($sqllmsDonations)) {
								//-----------------------------------------------------
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td style="text-align:center; padding-left: 5px; width: 50px;">'.$sr.'</td>
                                        <td>'.get_monthtypes($rowDonation['id_month']).'</td> 
                                        <td style="text-align:right; width: 150px;">'.$rowDonation['total_amount'].'</td> 
                                        <td style="text-align:center; width: 80px;">'.get_payments1($rowDonation['status']).'</td>
                                    </tr>';
                                    $grandTotal = ($grandTotal + $rowDonation['total_amount']);
								//-----------------------------------------------------
								}
								//-----------------------------------------------------
								echo '
                                <tr>
                                    <td colspan="2" style="text-align:center; font-size:12px; font-weight:bold; border:1px solid #333;">Total</td>
                                    <td colspan="2" style="text-align:right; font-size:12px; font-weight:bold;  border:1px solid #333;">'.number_format($grandTotal).'</td>
                                </tr>
							</tbody>
						</table>';
                        }
                        echo '
					</div>
				</div>';
			}
			echo '
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
}
?>