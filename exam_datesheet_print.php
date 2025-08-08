<?php
// error_reporting(all);
	require_once("include/dbsetting/lms_vars_config.php");
	require_once("include/dbsetting/classdbconection.php");
	require_once ("include/functions/functions.php");
	$dblms = new dblms();
	require_once("include/functions/login_func.php");
	checkCpanelLMSALogin();
//-----------------------------------------------
if(!empty($_SESSION['userlogininfo']['LOGINCAMPUS'])){
	$sql1 = " WHERE campus_id = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ";
	$sql2 = " AND t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  ";
}
else{
	$sql1 = "";
	$sql2 = "";
}
//------------------------ CAMPUS INFO -----------------------
$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_address, campus_email
									FROM ".CAMPUS." $sql1 LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);

//---------------------- DATESHEET -------------------------
$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
									e.type_name, c.class_name, i.instructions
									FROM ".DATESHEET." t
									INNER JOIN ".EXAM_TYPES."  	 e	ON 	e.type_id 		= t.id_exam
									INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
									LEFT JOIN ".EXAM_INSTRUCTIONS." i ON (
										i.id_examtype	= t.id_exam
										AND i.id_class	= t.id_class
										AND i.status	= '1'
										AND i.is_deleted= '0'
										AND i.id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
									)
									WHERE t.id = '".$_GET['id']."' AND t.is_deleted != '1'
									$sql2
									LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);

//------------------- DTAESHEET DETAILS ---------------------------------- 
$sqllmsdetail	= $dblms->querylms("SELECT d.dated, d.start_time, d.end_time, e.emply_name, s.subject_name, s.subject_code, r.room_no
								FROM ".DATESHEET_DETAIL." 	 d 
								INNER JOIN ".EMPLOYEES." 	 e 	ON 	e.emply_id 		= d.id_teacher
								INNER JOIN ".CLASS_SUBJECTS." s 	ON 	s.subject_id 	= d.id_subject
								INNER JOIN ".CLASS_ROOMS."    r 	ON 	r.room_id 		= d.id_room
								WHERE d.id_setup = ".$rowsvalues['id']."
								ORDER BY d.dated
								");
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
//-----------------------------------------------------

echo '
<div id="print">
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="assets/stylesheets/theme.css"/>

	<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>
	<script src="assets/vendor/jquery/jquery.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
			border: 1px solid #ffcfcf;
		}
		th {
			border: 1px solid #ffcfcf;
		}
	</style>
	<br>
	
		<img src="uploads/logo.png" style="max-height : 100px;">
		<center style="margin-top: -100px;  text-align:right">
			<h3 style="font-weight: 100;">Laurel Home International Schools <span style="text-transform: capitalize;">('.$value_campus['campus_name'].')</span></h3>
			'.$rowsvalues['type_name'].' '.$values_setting['session_name'].'
		</center>
	<br>

	<section class="panel">
		<header class="panel-heading">
			<h4 class="panel-title">
			'.$rowsvalues['type_name'].' Datesheet of Class '.$rowsvalues['class_name'].' </h4>
		</header>
		<div class="panel-body">
			<div class="table-responsive mb-md">
				<table class="table">
					<tbody>	
				
						
						<tr>
							<th class="center" width="70">Sr No. </th>
							<th>Days </th>
							<th>Date </th>
							<th>Subject  </th>
							<th>Room </th>
							<th>Invigilator </th>
							<th>Start Time </th>
							<th>End Time </th>
						</tr>';
						//-------------------------------------
						$srno = 0;
						while($rowsdetail = mysqli_fetch_array($sqllmsdetail))
						{
							$srno++;
							
							//--------------------------------------
							$dated = date("d F Y", strtotime($rowsdetail['dated']));
							$day = date("l", strtotime($rowsdetail['dated']));
							//--------------------------------------
							echo '					
							<tr>
								<td class="center">'.$srno.'</td>
								<td>'.$day.'</td>
								<td>'.$dated.'</td>
								<td>'.$rowsdetail['subject_name'].' ('.$rowsdetail['subject_code'].')</td>
								<td>'.$rowsdetail['room_no'].'</td>
								<td>'.$rowsdetail['emply_name'].'</td>
								<td>'.$rowsdetail['start_time'].'</td>
								<td>'.$rowsdetail['end_time'].'</td>
							</tr>';
						}
						echo'			
					</tbody>
				</table>
			</div>';
			if(!empty($rowsvalues['instructions'])){
				echo html_entity_decode($rowsvalues['instructions']);
			}else{
				echo'
				<h4>Instructions:</h4>
				<b>Missed Papers: </b> Any missed paper due to any urgency will be taken during the Exams Period (<u>'.$start.' to '.$end.'</u>) only, and not afterwards. <br>
				<b>Note: </b> Students will come In Examination Hall, along with:
				<ul>
					<li>Paper board</li>
					<li>Colour Box (Playgroup to One)</li>
					<li>Roll No Slip</li>
					<li>Geometry Box</li>
				</ul>';
			}
			echo'
		</div>
	</section>
</div>';
?>
<script type="text/javascript" language="javascript1.2">
 	//Do print the page
	if (typeof(window.print) != "undefined") {
		window.print();
	}
</script>
