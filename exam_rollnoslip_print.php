<?php
//-----------------------------------------------
// error_reporting(all);
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
if(!empty($_SESSION['userlogininfo']['LOGINCAMPUS'])){
	$sql = " WHERE campus_id = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ";
}
else{
	$sql = "";
}
//------------------------ CAMPUS INFO -----------------------
$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_address, campus_email
									FROM ".CAMPUS." $sql LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);
//---------------------- DATESHEET -------------------------
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
									e.type_name, c.class_name
									FROM ".DATESHEET." t
									INNER JOIN ".EXAM_TYPES."  	 e	ON 	e.type_id 		= t.id_exam
									INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
									WHERE e.type_id = '".$_POST['id_type']."' AND t.id_class = '".$_POST['id_class']."'
									AND t.is_deleted != '1' AND t.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
									AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//------------------- DTAESHEET DETAILS ---------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT d.dated, d.start_time, d.end_time, s.subject_name, s.subject_code
								FROM ".DATESHEET_DETAIL." 	 d 
								INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
								WHERE d.id_setup = ".$rowsvalues['id']."
								ORDER BY d.dated
								");
$examdetail = array();
while($rowsdetail = mysqli_fetch_array($sqllmsdetail)){
	$examdetail[] = $rowsdetail;
}
//------------------ EXAM SESSION NAME -----------------------------
$sqllms_setting	= $dblms->querylms("SELECT session_name 
											FROM ".SESSIONS."
											WHERE session_status ='1' AND is_deleted != '1' AND session_id = '".$_SESSION['userlogininfo']['EXAM_SESSION']."' LIMIT 1");
$values_setting = mysqli_fetch_array($sqllms_setting);

//---------------- SELECT EXAM SESSION DETAILS ----------------------
$sqllmsexam	= $dblms->querylms("SELECT  d.date_start, d.date_end
								   FROM ".EXAM_CALENDER." a 
								   INNER JOIN ".EXAM_CALENDER_DETAIL." d ON d.id_setup = a.id
								   WHERE a.is_deleted != '1' AND a.status = '1' AND a.published = '1'
								   AND a.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
								   AND d.id_type = '".$rowsvalues['id_exam']."' LIMIT 1");
//-----------------------------------------------------
$value_exam = mysqli_fetch_array($sqllmsexam);
//---------------------- Reformat Date -----------------
$start  = date("d M, Y", strtotime($value_exam['date_start']));
$end  = date("d M, Y", strtotime($value_exam['date_end']));

//------------------- STUDENT DETAILS ---------------------------
$sqllms_std	= $dblms->querylms("SELECT  s.std_name, s.std_fathername, s.std_rollno, s.std_regno, c.class_name, cs.section_name, s.std_photo
									FROM ".STUDENTS." 		s
									INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
									LEFT JOIN ".CLASS_SECTIONS."  cs  ON cs.section_id = s.id_section
									WHERE s.std_id != '' 
									AND s.is_deleted != '1' 
									AND s.id_class = '".$_POST['id_class']."'
									AND s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									ORDER BY s.std_id");
while($value_std = mysqli_fetch_array($sqllms_std)){
	if($value_std['std_photo']) { 
		$photo = "uploads/images/students/".$value_std['std_photo']."";
	}
	else{
		$photo = "uploads/default-student.jpg";
	}
//-----------------------------------------------------
echo '
<div id="print" style="orientation: landscape">
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="assets/stylesheets/theme.css"/>

	<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
	<script src="assets/vendor/jquery/jquery.js"></script>
	<style type="text/css">
	body .btn-primary {
		color: #ffffff;
		text-shadow: 0 -1px 0 rgb(0 0 0 / 25%);
		background-color: #cb3f44;
		border-color: #cb3f44;
	}
	body .btn {
		white-space: normal;
	}
	.ml-sm {
		margin-left: 10px !important;
	}
	.mb-xs {
		margin-bottom: 5px !important;
	}
	.pull-right {
		float: right !important;
	}
	.btn {
		margin-right:20px;
		display: inline-block;
		padding: 6px 12px;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.42857143;
		text-align: center;
		vertical-align: middle;
		touch-action: manipulation;
		cursor: pointer;
		user-select: none;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 4px;
	}
		td {
			padding: 5px;
			border: 1px solid #ffcfcf;
		}
		th {
			border: 1px solid #ffcfcf;
		}
		
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
	@page { 
		size: A4 potrait;
	   margin: 4mm 4mm 4mm 4mm; 
	}
	#printPageButton {
		display: none;
	}
}
	</style>
	<br>
	
		<img src="uploads/logo.png" style="max-height : 100px;">
		<center style="margin-top: -100px;  text-align:right">
			<h3 style="font-weight: 100;">Laurel Home International Schools <span style="text-transform: capitalize;">('.$value_campus['campus_name'].')</span></h3>
			Roll No Slip ('.$rowsvalues['type_name'].' - '.$values_setting['session_name'].')
		</center>
	<br>
    <table class="table mt-sm">
        <tr>
            <td style="text-align: left;"></u>Registration# <u>'.$value_std['std_regno'].'</td>
            <td style="text-align: right;">Roll no: <u>'.$value_std['std_rollno'].'</u></td>
			<td style="width: 150px; text-align: center;" rowspan="3"><img src="'.$photo.'" style="width:120px; height:150px;"></td>
        </tr>
        <tr>
            <td style="text-align: left;">Student: <u>'.$value_std['std_name'].'</u> </td>
            <td style="text-align: right;">Father: <u>'.$value_std['std_fathername'].'</u></td>
        </tr>
        <tr>
            <td style="text-align: left;">Class: <u>'.$value_std['class_name'].'</u> </td>
            <td style="text-align: right;">Section: <u>'.$value_std['section_name'].'</u></td>
        </tr>
    </table>
	<section class="panel mt-md">
		<div>
			<table class="table">
				<tbody>	
					<tr>
						<th class="center" width="70">Sr No. </th>
						<th>Day </th>
						<th>Date </th>
						<th>Subject  </th>
						<th>Start Time </th>
						<th>End Time </th>
					</tr>';
					//-------------------------------------
					$srno = 0;
					foreach($examdetail as $exam)
					{
						$srno++;
						
						//--------------------------------------
						$dated = date("d F Y", strtotime($exam['dated']));
						$day = date("l", strtotime($exam['dated']));
						//--------------------------------------
						echo '					
						<tr>
							<td class="center">'.$srno.'</td>
							<td>'.$day.'</td>
							<td>'.$dated.'</td>
							<td>'.$exam['subject_name'].' ('.$exam['subject_code'].')</td>
							<td>'.$exam['start_time'].'</td>
							<td>'.$exam['end_time'].'</td>
						</tr>';
					}
					echo'			
				</tbody>
			</table>
			<h4 style="margin-top: 40px;"><u>Instructions:</u></h4>
			<b>Missed Papers: </b> Any missed paper due to any urgency will be taken during the Exams Period (<u>'.$start.' to '.$end.'</u>) only, and not afterwards. <br>
			<b>Note: </b> Students will come In Examination Hall, along with:
				<ul>
						<li>Paper board</li>
						<li>Colour Box (Playgroup to One)</li>
						<li>Roll No Slip</li>
						<li>Geometry Box</li>
				</ul>

            <h4>Examination center: <u style="text-transform: capitalize;">'.$value_campus['campus_name'].'</u></h4>
            <h4 style="text-align: right; margin-top: -25px;">Issued By: <u style="text-transform: capitalize;">'.$_SESSION['userlogininfo']['LOGINNAME'].'</u></h4>

		</div>
	</section>
</div>
<div class="page-break"></div>';

}
echo '<button type="button" id="printPageButton" onClick="window.print();" class="modal-with-move-anim ml-sm mb-xs btn btn-primary btn-xs pull-right">Print</button>';
?>

