<?php 
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//------------------------------------------------
$sqllmsStudent  = $dblms->querylms("SELECT s.std_id, s.std_name, s.std_fathername, s.std_gender, s.std_dob, s.std_bloodgroup, s.id_country, s.std_city, s.std_nic, s.std_religion,
										s.std_phone, s.std_whatsapp, s.std_email, s.std_address, s.std_regno, s.std_rollno, s.admission_formno, s.std_admissiondate, s.std_photo,
										c.class_name, se.section_name, ss.session_name  
										FROM ".STUDENTS." s 
										INNER JOIN ".CLASSES." c ON c.class_id = s.id_class 
										LEFT JOIN ".CLASS_SECTIONS." se ON se.section_id = s.id_section
										INNER JOIN ".SESSIONS." ss ON ss.session_id = s.id_session
										WHERE s.std_id = '".$_GET['id']."'
										AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
										LIMIT 1");
if(mysqli_num_rows($sqllmsStudent) == 1){

$rowStudent = mysqli_fetch_array($sqllmsStudent);
//------------------------------------------------
echo '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admission Form </title>
<style type="text/css">
	body { font-size:14px; overflow: -moz-scrollbars-vertical; margin:0; font-family: Arial, Helvetica, sans-serif, Calibri; }
	h1 { font-size:33px; font-weight:700; margin:0; margin-bottom:0; padding-bottom:0;  }
	h2 { font-size:27px; font-weight:normal; margin-top:0; }
	.admissionform { margin-top:10px;background-color:#000; color:#fff; width:300px; font-size:32px; font-weight:700; font-style:italic; } 
	th { font-weight:600; font-size:14px; }
	td { font-size:14px; }

@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: letter;
		size: portrait; 
	}
}
	
</style>
</head>

<body>';
//------------------------------------------------
	if($rowStudent['std_photo']) { 
		$stdphoto = 'uploads/images/students/'.$rowStudent['std_photo'];
	} else {
		$stdphoto = 'uploads/default-student.jpg';
	}
//-----------------------------------------------
echo '
<center>
<div style="margin-top:10px;">
<table width="960" border="0" style="border-collapse:collapse;" cellpadding="5">
	<tbody>
		<tr>
			<td width="141" height="122" valign="top" align="left"><img src="uploads/logo.png" alt="MUL Logo" height="100" width="100"/></td>
			<td valign="top" align="center">
				<h1>'.SCHOOL_NAME.'</h1>
				<div class="admissionform">ADMISSION FORM</div>
			</td>
			<td width="100" valign="top" align="right"><img src="'.$stdphoto.'" alt="COSIS Logo" height="110" width="100"/></td>
		</tr>
	</tbody>
</table>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="100">Reg. No.: </td>
			<td width="140" style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_regno'].'</td>
			<td width="100" style="text-align:right">Class: </td>
			<td width="180" style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['class_name'].'</td>
			<td width="100" style="text-align:right">Session: </td>
			<td width="120" style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['session_name'].'</td>
			<td width="100" style="text-align:right">Admission: </td>
			<td width="120" align="left" style="border-bottom:1px dashed #666666 !important; text-align:left;">'.$rowStudent['std_admissiondate'].'</td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="100">Student Name: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_name'].'</td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="100">Father Name: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_fathername'].'</td>
		</tr>
	</tbody>
</table>

<br/>


<table width="960" border="0" align="center">
<tbody>
<tr>
	<td width="38">CNIC: </td>';
//----------------------------------------
	if(!empty($rowStudent['std_nic'])) { 
	//----------------------------------------
		for ($ic=0; $ic<strlen($rowStudent['std_nic']); $ic++) {
		echo '<td width="19" style="border:1px solid #666; text-align:center;">'.$rowStudent['std_nic'][$ic].'</td>'; 
		}
	//----------------------------------------
	} else { 
	//----------------------------------------
		echo '
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666; text-align:center;">-</td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;"></td>
		<td width="19" style="border:1px solid #666;text-align:center;">-</td>
		<td width="19" style="border:1px solid #666;"></td>';
	//----------------------------------------
	}
//----------------------------------------
echo '
	<td width="0"></td>
	<td width="320"></td>
	<td width="40">Mother: </td>
	<td width="162" style="text-align:left; border-bottom:1px dashed #666666 !important;"></td>
</tr>
</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="100">Date of Birth: </td>
			<td width="360" style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_dob'].'</td>
			<td width="100" style="text-align:right">Place of Birth: </td>
			<td width="320" style="text-align:left;border-bottom:1px dashed #666666 !important;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
<tbody>
<tr>
	<td width="67">Gender: </td>
	<td width="201" style="border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_gender'].'</td>
	<td width="62" style="text-align:right">Religion: </td>
	<td width="227" align="left" style="border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_religion'].'</td>
	<td width="327" style="text-align:right;">
		Any Physical / Non Physical Deformity: 
		<br><span style="font-size: 12px; text-align: center;">If "yes" then attach report</span>
	</td>
	<td width="25" style="border:1px solid #666; text-align: center;">Yes</td>
	<td width="25" style="border:1px solid #666; text-align: center;">No</td>
</tr>
</tbody>
</table>

<br/>


<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="65">City: </td>
			<td width="362" style="text-align:left; border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_city'].'</td>
			<td width="159" style="text-align:right">Nationality: </td>
			<td width="356" style="text-align:left;border-bottom:1px dashed #666666 !important;">Pakistani</td>
		</tr>
	</tbody>
</table>

<br/>


<table width="960" border="0" align="center">
<tbody>
<tr>
	<td width="70">Address: </td>
	<td width="870" align="left" style="border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_address'].'</td>
</tr>
</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
<tbody>
<tr>
	<td width="32">Phone: </td>
	<td width="110" style="border-bottom:1px dashed #666666 !important; text-align:center;">'.$rowStudent['std_phone'].'</td>
	<td width="32">Whatsapp: </td>
	<td width="110" style="border-bottom:1px dashed #666666 !important; text-align:center;">'.$rowStudent['std_whatsapp'].'</td>
	<td width="107" style="text-align:right">Email Address: </td>
	<td width="551" align="left" style="border-bottom:1px dashed #666666 !important;">'.$rowStudent['std_email'].'</td>
</tr>
</tbody>
</table>
</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="190">Father\'s/Guardian Occuption: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="110">Monthly Income: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="110">Previous School: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="200">Reason for leaving last school: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="60">Details of Sibling</td>

			<table width="900" border="1px soild #666666 !important;" align="center" style="border-collapse: collapse;">
				<tr>
					<th style="width: 400px;">Name</th>
					<th style="width: 100px;">Age</th>
					<th style="width: 400px;">Institution with class</th>
				</tr>
				<tr>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
				</tr>
				<tr>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
				</tr>
				<tr>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
					<th style="height: 12px;"></th>
				</tr>
			</table>
		</tr>
	</tbody>
</table>

<br/>

<table width="400" border="0" align="center">
	<tbody>
		<tr>
			<td width="200">Signature of Parent/Guardian: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important; width:200;"></td>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td style="font-weight: bold; text-decoration: underline; width:110;">Admission Refrence: </td>
			<table width="960" border="0" align="center">
				<tbody>
					<tr>
						<b>Advertisement <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
						<b>T.V Ad <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
						<b>Newspaper Ad <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
						<b>Banner Ad <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
						<b>Hand Bill <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px; margin-left: 3px;"></span></b>
					</tr>
				</tbody>
			</table>
		</tr>
	</tbody>
</table>

<br/>

<table width="960" border="0" align="center">
	<tbody>
		<tr>
			<td width="170">Any Other/Contact Person: </td>
			<td style="text-align:left; border-bottom:1px dashed #666666 !important; width:200;"></td>
		</tr>
	</tbody>
</table>

<br/>

<hr>

<table width="960">
	<h2 style="font-weight: bold;">For Office Use</h2>
	<h3><b style="font-weight:bold; text-align:left !important; text-decoration: underline;">Document Attached</b></h3>
	<table width="940" border="0">
		<tbody>
			<tr>
				<b>ID Copy <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
				<b>Copy Birth Certificate <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
				<b>Photographs Ad <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
				<b>School Leaving Certificate <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px;"></span></b>
			</tr>
			<br/><br/>
			<tr>
				<b>Admitted In Class <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px; margin-left: 3px;">'.$rowStudent['class_name'].'</span></b>
				<b>Section <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px; margin-left: 3px;"></span>'.$rowStudent['section_name'].'</b>
				<b>Admission Date <span style="border:1px solid #666; padding: 0 10px; margin-right: 20px; margin-left: 3px;">'.$rowStudent['std_admissiondate'].'</span></b>
			</tr>
		</tbody>
	</table>
</table>

<br/><br/><br/><br/>

<table width="960" border="0" align="center">
<tbody>
<tr style="margin-top: 80px;">
	<td width="320" style="text-align:center; border-top:1px solid #666666 !important;">Office Superintendent</td>
	<td width="320" style="text-align:center; border-top:1px solid #666666 !important;">Vice Principal</td>
	<td width="320" style="text-align:center; border-top:1px solid #666666 !important;">Principal</td>
</tr>
</tbody>
</table>

</div>
</center>
<!--<div class="page-break"></div>-->
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