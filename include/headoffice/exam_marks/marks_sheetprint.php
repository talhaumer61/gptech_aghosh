<?php
$sqllmsChk	= $dblms->querylms("SELECT m.id
								FROM ".EXAM_MARKS." m 
								INNER JOIN ".EXAM_MARKS_DETAILS."	md ON m.id		=	md.id_setup
								WHERE m.id_exam = '".cleanvars($examtype)."'
								AND m.id_class = '".cleanvars($class)."'
								AND m.is_deleted = '0'
								AND m.id_campus = '".cleanvars($id_campus)."' 
								LIMIT 1");
if(mysqli_num_rows($sqllmsChk)){
	if(!empty(cleanvars($id_campus))){
		$sql1 = " WHERE campus_id = '".cleanvars($id_campus)."' ";
		$sql2 = " AND t.id_campus = '".cleanvars($id_campus)."'  ";
	}
	else{
		$sql1 = "";
		$sql2 = "";
	}

	$sqlGrade = $dblms->querylms("SELECT g.*
									FROM ".GRADESYSTEM." g
									WHERE g.is_deleted = '0'
								");
	$grades = array();
	while($valGrade = mysqli_fetch_array($sqlGrade)){
		$grades[] = $valGrade;
	}

	//------------------------ CAMPUS INFO -----------------------
	$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_phone, campus_address, campus_email
										FROM ".CAMPUS." $sql1 LIMIT 1");
	$value_campus = mysqli_fetch_array($sqllmscampus);
	//---------------------- DATESHEET -------------------------
	$sqllms	= $dblms->querylms("SELECT t.id, t.status, t.id_exam, t.id_session, t.id_class, t.id_section, t.id_campus,
								e.type_name, c.class_name
								FROM ".DATESHEET." t
								INNER JOIN ".EXAM_TYPES."	e	ON	e.type_id	= t.id_exam
								INNER JOIN ".CLASSES."		c 	ON	c.class_id	= t.id_class
								WHERE t.id_exam = '".cleanvars($examtype)."'
								AND t.id_class = '".cleanvars($class)."'
								AND t.is_deleted = '0'
								AND t.id_campus = '".cleanvars($id_campus)."' 
								LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);

	//------------------- DTAESHEET DETAILS ---------------------------------- 
	$sqllmsdetail	= $dblms->querylms("SELECT d.total_marks, d.passing_marks, d.dated
										FROM ".DATESHEET_DETAIL." 	 d 
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
												WHERE session_status ='1' AND is_deleted != '1' LIMIT 1");
	$values_setting = mysqli_fetch_array($sqllms_setting);

	echo'
	<div>
		<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
			<header class="panel-heading">
				<button onclick="print_report(\'printReport\')" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-print"></i> Print Report Cards</button>
				<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> Students Progress Report</h2>
			</header>
			<div class="panel-body" id="printReport">
				<style type="text/css">
					.page-break {
						-webkit-print-color-adjust: exact !important;
					}
					@media print {
						.page-break	{
							page-break-before: always;
						}
						@page { 
							 
						}
					}
					td,th{
						font-size: 11px;
					}
					table{
						border-spacing: 0;
						border-collapse: collapse;
					}
					.td-border {
						padding: 5px;
						border: 1px solid #ddd;
					}
					.th-border {
						padding: 5px;
						border: 1px solid #ddd; 
					}
					.font-times{
						font-family:"Times New Roman", Times, serif; 
						color:#000; 
						font-weight:bold;
					}
					.text-center{
						text-align:center;
					}
					.text-right{
						text-align:right;
					}
					.border-bottom{
						border-bottom: 1px solid #777;
					}
					.pr-10{
						padding-right: 5px;
					}
					.pl-10{
						padding-left: 5px;
					}
				</style>';
				//------------------- STUDENT DETAILS ---------------------------
				$k=0;
				$sqlStd	= $dblms->querylms("SELECT  s.std_id, s.std_name, s.std_fathername, s.std_rollno, s.std_regno, c.class_name, s.std_photo,s.std_admissiondate
												FROM ".STUDENTS." 		s
												INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
												INNER JOIN ".EXAM_MARKS_DETAILS."	md ON s.std_id		=	md.id_std
												WHERE s.std_id != '' 
												AND s.is_deleted != '1' 
												AND s.id_class = '".$_POST['id_class']."'												
												AND s.id_campus = '".cleanvars($id_campus)."' 
												group by s.std_id
												ORDER BY s.std_id");
				while($valStd = mysqli_fetch_array($sqlStd)){
					$year = date('Y',strtotime($valStd['std_admissiondate']));
					$sr = $year.$valStd['std_id'];

					if($valStd['std_photo']) { 
						$photo = "uploads/images/students/".$valStd['std_photo']."";
					}else{
						$photo = "uploads/default-student.jpg";
					}
					$k++;
					$sqllmss	= $dblms->querylms("SELECT
														m.id, m.total_marks, m.status, m.id_exam, m.id_class, m.id_subject, m.id_session, m.id_section,
														s.subject_name,
														c.class_name, 
														se.session_id, se.session_name, 
														d.id_setup, d.id_std, d.obtain_marks 
														FROM ".EXAM_MARKS." m 
														INNER JOIN ".CLASS_SUBJECTS."		s ON s.subject_id	=	m.id_subject
														INNER JOIN ".CLASSES."				c ON c.class_id		=	m.id_class
														INNER JOIN ".SESSIONS."				se ON se.session_id	=	m.id_session
														INNER JOIN ".EXAM_MARKS_DETAILS."	d ON d.id_setup		=	m.id
														WHERE m.id_campus = '".cleanvars($id_campus)."'
														AND d.id_std = '".cleanvars($valStd['std_id'])."'
														AND m.id_exam = '".cleanvars($examtype)."'
													");
					echo'
					<div class="table-responsive page-break">
						<table width="100%">
							<tbody>
								<tr>
									<td class="text-center" width="80"><img src="uploads/logo.png" style="max-height : 80px;"></td>
								</tr>
								<tr>
									<td class="text-center">
										<h3><b>Laurel Home International Schools</b></h3>
										<h4><b><span style="text-decoration:underline">'.$value_campus['campus_name'].'</span></b></h4>
										<h6><b>'.$value_campus['campus_phone'].' / '.$value_campus['campus_email'].'</b></h6>
									</td>
								</tr>
							</tbody>
						</table>
						<table width="100%">
							<tbody>
								<tr>
									<td class="text-center" rowspan="4" width="150"><img src="'.$photo.'" width="100" height="100" style="border-radius: 50%;"></td>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Serial No: <b>'.$sr.'</b></div></td>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Reg No: <b>'.$valStd['std_regno'].'</b></div></td>
									<td></td>
								</tr>
								<tr>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Student Name: <b>'.$valStd['std_name'].'</b></div></td>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Father Name: <b>'.$valStd['std_fathername'].'</b></div></td>
									<td></td>
								</tr>
								<tr>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Class: <b>'.$valStd['class_name'].'</b></div></td>
									<td class="pr-10 pl-10" width="200"><div class="border-bottom">Roll No: <b>'.$valStd['std_rollno'].'</b></div></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table width="100%">
							<tbody>
								<tr>
									<td class="text-center">
										<h4 class="" style="text-decoration: underline;"><b>Result Card '.(!empty($rowsvalues['type_name']) ? ', '.$rowsvalues['type_name'].'' : '').'</b></h4>
									</td>
								</tr>
							</tbody>
						</table>
						<table style="width:100%;" style="margin-top:10px;" class="table table-bordered table-striped table-condensed mb-none">
							<thead>
								<tr>
									<th width="40" class="text-center">Sr.</th>
									<th class="text-center">Subject Name</th>
									<th class="text-center">Total Marks</th>
									<th class="text-center">Obtained Marks</th>
									<th class="text-center">Percentage</th>
								</tr>
							</thead>
							<tbody>';
							$obt_total      = 0;
							$grand_total    = 0;
							$percentage     = 0;
							$i=0;
							while($valuesqllmss = mysqli_fetch_array($sqllmss)){
								$i++;
								$percentage = round((($valuesqllmss['obtain_marks']/$valuesqllmss['total_marks'])*100),2);
								echo'
								<tr>
									<td class="text-center">'.$i.' </td>
									<td>'.$valuesqllmss['subject_name'].' </td>
									<td class="text-center">'.$valuesqllmss['total_marks'].' </td>
									<td class="text-center">'.$valuesqllmss['obtain_marks'].'</td>
									<td class="text-center">'.$percentage.'%</td>
								</tr>';
								$obt_total = $obt_total + $valuesqllmss['obtain_marks'];
								$grand_total = $grand_total + $valuesqllmss['total_marks'];
							}
							$percent = round((($obt_total/$grand_total)*100),2);
							echo'
								<tr>
									<td class="td-border text-center" colspan="2"><b>Grand Total</b></td>
									<td class="text-center td-border"><b>'.$grand_total.'</b></td>
									<td class="text-center td-border"><b>'.$obt_total.'</b></td>
									<td class="text-center td-border"><b>'.$percent.'%</b></td>
								</tr>
							</tbody>
						</table>
						<table width="100%" style="margin-top:10px;">
							<tbody>
								<tr>
									<td class="text-center">
										<h5 style="text-decoration: underline"><b>Development in Behavior</b></h5>
									</td>
								</tr>
							</tbody>
						</table>
						<table width="100%"  class="table table-bordered table-striped table-condensed mb-none">
							<thead>
								<tr>
									<th class="text-center">Traits</th>
									<th class="text-center" width="100">Score(10-1)</th>
									<th class="text-center">Traits</th>
									<th class="text-center" width="100">Score(10-1)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Interest in Academic Activities</td>
									<td></td>
									<td>Interest in Completion of Home/Class Assignment</td>
									<td></td>
								</tr>
								<tr>
									<td>Application of Knowledge</td>
									<td></td>
									<td>Dress and Personal Hygiene</td>
									<td></td>
								</tr>
								<tr>
									<td>Spirit of Cooperation</td>
									<td></td>
									<td>Observance and Application of School/Class Rules</td>
									<td></td>
								</tr>
								<tr>
									<td>Mixing with Peer Socially/Academically</td>
									<td></td>
									<td>Respect to Class/School Inventory</td>
									<td></td>
								</tr>
								<tr>
									<td>Obedience and Respectfulness</td>
									<td></td>
									<td>Participation in Co-Curricular Activities</td>
									<td></td>
								</tr>
								<tr>
									<td>Overall Conduct</td>
									<td></td>
									<td>Number of Attendance</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2">Total Score</td>
									<td colspan="2"></td>
								</tr>
							</tbody>
						</table> 
						<table width="100%" class="table table-bordered table-striped table-condensed" style="margin-top:10px;">
							<tbody>
								<tr>
									<th rowspan="2">Grading</th>';
									foreach($grades as $grade){
										$select = '';
										if($grade['grade_lowermark']<= round($percent)){
											if(round($percent) <= $grade['grade_uppermark']){
												$select = 'style="background: #37F713;"';
											}else{
												$select = '';
											}
										}
										echo'<td class="text-center" '.$select.'>'.$grade['grade_name'].'</td>';
									}
									echo'
								</tr>
								<tr>';
									foreach($grades as $grade){
										$select = '';
										if($grade['grade_lowermark']<= round($percent)){
											if(round($percent) <= $grade['grade_uppermark']){
												$select = 'style="background: #37F713;"';
											}else{
												$select = '';
											}
										}
										echo'<td class="text-center" '.$select.'>'.$grade['grade_comment'].'</td>';
									}
									echo'
								</tr>
							</tbody>
						</table>
						<br>
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td width="120"><b>CLASS TEACHER: </b></td>
									<td width="150" style="border-bottom: 1px solid;"></td>
									<td></td>
									<td width="150" class="text-center"><b>EXAM COORDINATOR: </b></td>
									<td width="150" style="border-bottom: 1px solid;"></td>
								</tr>
							</tbody>
						</table>
						<br>
					</div>';
				}
				echo'
				<script type="text/javascript">
					function print_report(printReport) {
						var printContents = document.getElementById(printReport).innerHTML;
						var originalContents = document.body.innerHTML;
						document.body.innerHTML = printContents;
						window.print();
						document.body.innerHTML = originalContents;
					}
				</script>
			</div>
		</section>
</div>';
}else{
	echo '
	<section class="panel panel-featured panel-featured-primary appear-animation mt-sm fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
		<h2 class="panel-body text-center font-bold mt-none text text-danger">No Record Found</h2>
	</section>';
}
?>