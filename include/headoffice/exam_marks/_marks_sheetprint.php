<?php
$sqllmsChk	= $dblms->querylms("SELECT id
								FROM ".EXAM_MARKS." m 
								WHERE m.id_exam = '".cleanvars($examtype)."'
								AND m.id_class = '".cleanvars($class)."'
								$sqlSection
								AND m.is_deleted = '0' AND m.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
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
	
	//------------------------ CAMPUS INFO -----------------------
	$sqllmscampus	= $dblms->querylms("SELECT campus_id, campus_code, campus_name, campus_address, campus_email
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
								$sqlSection_t
								AND t.is_deleted = '0' AND t.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
								AND t.id_campus = '".cleanvars($id_campus)."' 
								LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);

	//------------------- DTAESHEET DETAILS ---------------------------------- 
	$sqllmsdetail	= $dblms->querylms("SELECT d.total_marks, d.passing_marks, d.dated, s.subject_id, s.subject_name, s.subject_code
										FROM ".DATESHEET_DETAIL." 	 d 
										INNER JOIN ".CLASS_SUBJECTS." s	ON	s.subject_id	= d.id_subject
										WHERE d.id_setup = ".$rowsvalues['id']."
										$sqlMarksSubject_s
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
					td {
					}
					
					th {
						background-color: #0088cc;
						color: white;
					}
					.font-times{
						font-family:"Times New Roman", Times, serif; 
						color:#000; 
						font-weight:bold;
					}
				</style>';

				//------------------- STUDENT DETAILS ---------------------------
				$k=0;
				$sqllms_std	= $dblms->querylms("SELECT  s.std_id, s.std_name, s.std_fathername, s.std_rollno, s.std_regno, c.class_name, cs.section_name, s.std_photo
												FROM ".STUDENTS." 		s
												INNER JOIN ".CLASSES."  c  ON c.class_id = s.id_class
												INNER JOIN ".CLASS_SECTIONS."  cs  ON cs.section_id = s.id_section
												WHERE s.std_id != '' 
												AND s.is_deleted != '1' 
												AND s.id_class = '".$_POST['id_class']."'												
                                                $sqlStdSection
												AND s.id_campus = '".cleanvars($id_campus)."' 
												ORDER BY s.std_id");
				while($value_std = mysqli_fetch_array($sqllms_std)){
					$k++;
					$sqllmss	= $dblms->querylms("SELECT
														m.id, m.total_marks, m.status, m.id_exam, m.id_class, m.id_section, m.id_subject, m.id_session, 
														s.subject_name, 
														c.class_name, 
														cs.section_name, cs.section_strength, 
														se.session_id, se.session_name, 
														d.id_setup, d.id_std, d.obtain_marks 
														FROM ".EXAM_MARKS." m 
														INNER JOIN ".CLASS_SUBJECTS."		s ON s.subject_id	=	m.id_subject
														INNER JOIN ".CLASSES."				c ON c.class_id		=	m.id_class
														INNER JOIN ".CLASS_SECTIONS."		cs ON cs.section_id	=	m.id_section
														INNER JOIN ".SESSIONS."				se ON se.session_id	=	m.id_session
														INNER JOIN ".EXAM_MARKS_DETAILS."	d ON d.id_setup		=	m.id
														WHERE m.id_campus = '".cleanvars($id_campus)."'
														AND d.id_std = '".cleanvars($value_std['std_id'])."'
														$sqlMarksSubject_s
														AND m.id_exam = '".cleanvars($examtype)."'
													");
					echo'
					<div class="table-responsive page-break">
						<table width="100%">
							<tbody>
								<tr>
									<td class="text-center" width="200"><img src="uploads/logo.png" style="max-height : 150px;"></td>
									<td class="text-center">
										<h1 class="font-times">Laurel Home International Schools</h1>
										<h3 class="font-times">Campus Name: <span style="text-decoration:underline">'.$value_campus['campus_name'].'</span></h3>
									</td>
								</tr>
							</tbody>
						</table>
						<table width="100%">
							<tbody>
								<tr>
									<td class="text-center" width="200"></td>
									<td><b>Student Name: </b><span>'.$value_std['std_name'].'</span></td>
									<td><b>Roll No: </b><span>'.$value_std['std_rollno'].'</span></td>
								</tr>
								<tr>
									<td class="text-center" width="200"></td>
									<td><b>Class: </b><span>'.$value_std['class_name'].'</span></td>
									<td><b>Section: </b><span>'.$value_std['section_name'].'</span></td>
								</tr>
								<tr>
									<td class="text-center" width="200"></td>
									<td><b>Session: </b><span>'.$values_setting['session_name'].'</span></td>
									<td><b>Term: </b><span>'.$rowsvalues['type_name'].'</span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="table-responsive" style="padding: 0 5rem;">
						<table style="width:100%; margin-top: 10px;" border="1" class="table table-bordered table-striped table-condensed mb-none">
							<thead>
								<tr>
									<th width="40" class="center">Sr.</th>
									<th>Subject Name</th>
									<th class="center">Total Marks</th>
									<th class="center">Obtained Marks</th>
								</tr>
							</thead>
							<tbody>';
							$obt_total = 0;
							$grand_total = 0;
							$i=0;
							while($valuesqllmss = mysqli_fetch_array($sqllmss)){
								$i++;
								echo'
								<tr>
									<td class="center">'.$i.' </td>
									<td>'.$valuesqllmss['subject_name'].' </td>
									<td class="center">'.$valuesqllmss['total_marks'].' </td>
									<td class="center">'.$valuesqllmss['obtain_marks'].'</td>
								</tr>';
								$obt_total = $obt_total + $valuesqllmss['obtain_marks'];
								$sub_tmarks = $valuesqllmss['total_marks'];
								$grand_total = $grand_total + $sub_tmarks;
							}
							$per = round((($obt_total/$grand_total)*100),2);
							echo'
								<tr>
									<td class="center" colspan="2"><b>Total</b></td>
									<td class="center"><b>'.$grand_total.'</b></td>
									<td class="center"><b>'.$obt_total.'</b></td>
								</tr>
							</tbody>
						</table>
						<br>';
						?>

						<div class="panel-body text-center" style="width: 610px; border: 0.5px solid #CCCCCC;">
							<div id="chart<?=$k?>" style="height: 250px;"></div>
						</div>
						<script type="application/javascript">
							//STUDENT LAST EXAM MARK GRAPH
							Highcharts.chart('chart<?=$k?>', {
								chart: {
									type: 'column',
									backgroundColor: 'transparent'
								},
								title: {
									text: 'Result Analysis'
								},
								xAxis: {
									categories: [
										<?php
											foreach ($examdetail as $subject):
												echo '"'.html_entity_decode($subject['subject_name']).'",';
											endforeach;
											?>
									],
									crosshair: true
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Marks & Position'
									}
								},
								tooltip: {
									crosshairs: true,
									shared: true
								},
								credits: {
									enabled: false
								},
								legend: {
									itemStyle: {
										"color": "#505461"
									},
									itemHoverStyle: {
										"color": "#505461"
									}
								},
								plotOptions: {
									bar: {
										dataLabels: {
											enabled: true
										}
									}
								},
								series: [{
										name: 'Achieved Marks',
										data: [
											<?php
											foreach ($examdetail as $subjectid):
												$sqlObtMarks	= $dblms->querylms("SELECT
																				m.id, m.total_marks, m.status, m.id_exam, m.id_class, m.id_section, m.id_subject, m.id_session, 
																				d.id_setup, d.id_std, d.obtain_marks 
																				FROM ".EXAM_MARKS." m 
																				INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
																				WHERE m.id_campus = '".cleanvars($id_campus)."'
																				AND m.id_subject = '".cleanvars($subjectid['subject_id'])."'
																				AND d.id_std = '".cleanvars($value_std['std_id'])."'
																				AND m.id_exam = '".cleanvars($examtype)."'
																				AND m.id_class = '".cleanvars($class)."'
																				$sqlSection
																				$sqlMarksSubject
																			");
												$valueObtMarks = mysqli_fetch_array($sqlObtMarks);
												echo '{y:'.$valueObtMarks['obtain_marks'].'},';
											endforeach;
											?>
										]
									},
									{
										name: 'Class Position',
										data: [
											<?php							
											foreach ($examdetail as $subjectid):
												$sqlObtMarks	= $dblms->querylms("SELECT d.obtain_marks 
																				FROM ".EXAM_MARKS." m 
																				INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
																				WHERE m.id_campus	= '".cleanvars($id_campus)."'
																				AND m.id_subject	= '".cleanvars($subjectid['subject_id'])."'
																				AND d.id_std		= '".cleanvars($value_std['std_id'])."'
																				AND m.id_exam       = '".cleanvars($examtype)."'
																				AND m.id_class      = '".cleanvars($class)."'
																				$sqlSection
																				$sqlMarksSubject
																			");
												$valueObtMarks = mysqli_fetch_array($sqlObtMarks);

												$sqlClassPos	= $dblms->querylms("SELECT COUNT(m.id) as std_count
																				FROM ".EXAM_MARKS." m 
																				INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
																				WHERE m.id_campus	= '".cleanvars($id_campus)."'
																				AND m.id_subject	= '".cleanvars($subjectid['subject_id'])."'
																				AND m.id_exam       = '".cleanvars($examtype)."'
																				AND m.id_class      = '".cleanvars($class)."'
																				AND m.id_section    = '".cleanvars($section)."'
																				AND d.obtain_marks	> '".cleanvars($valueObtMarks['obtain_marks'])."'
																			");
												$valueClassPos = mysqli_fetch_array($sqlClassPos);
												$std_count = $valueClassPos['std_count'] + 1;
												echo '{y:'.$std_count.'},';
											endforeach;
											?>
										]
									},
									{
										name: 'Section Position',
										data: [
											<?php
											foreach ($examdetail as $subjectid):
												$sqlObtMarks	= $dblms->querylms("SELECT d.obtain_marks 
																				FROM ".EXAM_MARKS." m 
																				INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
																				WHERE m.id_campus	= '".cleanvars($id_campus)."'
																				AND m.id_subject	= '".cleanvars($subjectid['subject_id'])."'
																				AND d.id_std		= '".cleanvars($value_std['std_id'])."'
																				AND m.id_exam       = '".cleanvars($examtype)."'
																				AND m.id_class      = '".cleanvars($class)."'
																				$sqlSection
																				$sqlMarksSubject
																			");
												$valueObtMarks = mysqli_fetch_array($sqlObtMarks);

												$sqlClassPos	= $dblms->querylms("SELECT COUNT(m.id) as std_count
																				FROM ".EXAM_MARKS." m 
																				INNER JOIN ".EXAM_MARKS_DETAILS." d ON d.id_setup = m.id
																				WHERE m.id_campus	= '".cleanvars($id_campus)."'
																				AND m.id_subject	= '".cleanvars($subjectid['subject_id'])."'
																				AND m.id_exam       = '".cleanvars($examtype)."'
																				AND m.id_class      = '".cleanvars($class)."'
																				AND m.id_section    = '".cleanvars($section)."'
																				AND d.obtain_marks	> '".cleanvars($valueObtMarks['obtain_marks'])."'
																			");
												$valueClassPos = mysqli_fetch_array($sqlClassPos);
												$std_count = $valueClassPos['std_count'] + 1;
												echo '{y:'.$std_count.'},';
											endforeach;
											?>
										]
									}
								]
							});
						</script>
						<?php
						// CHECK GRADE
						$sqlGrades  = $dblms->querylms("SELECT grade_name, grade_comment 
														FROM ".GRADESYSTEM."
														WHERE grade_lowermark <= '".round($per)."'
														AND   grade_uppermark >= '".round($per)."'
													");
						$valGrades = mysqli_fetch_array($sqlGrades);
						echo'
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td width="300"><b>Teacher Feedback </b></td>
									<td></td>
									<td width="100"><b>Percentage:</b></td>
									<td width="100" style="border-bottom: 1.5px solid;" class="text-center"><b>'.$per.'%</b></td>
									<td width="70"></td>
								</tr>
							</tbody>
						</table>
						<table width="100%">
							<tbody>
								<tr>
									<td width="300" style="border-bottom: 1.5px solid;"></td>
									<td></td>
									<td width="60"><b>Grade:</b></td>
									<td width="140" style="border-bottom: 1.5px solid;" class="text-center"><b>'.$valGrades['grade_name'].'</b></td>
									<td width="70"></td>
								</tr>
							</tbody>
						</table>
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td width="300" style="border-bottom: 1.5px solid;"></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<br>
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td width="130"><b>Total School Days</b></td>
									<td width="120" style="border-bottom: 1.5px solid;"></td>
									<td width="80" class="text-right"><b>Attended</b></td>
									<td width="120" style="border-bottom: 1.5px solid;"></td>
									<td width="70" class="text-right"><b>Absent</b></td>
									<td width="120" style="border-bottom: 1.5px solid;"></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td width="100"><b>Principal Sign</b></td>
									<td width="120" style="border-bottom: 1.5px solid;"></td>
									<td width="100" class="text-right"><b>Teacher Sign</b></td>
									<td width="120" style="border-bottom: 1.5px solid;"></td>
									<td width="90" class="text-right"><b>Parents Sign</b></td>
									<td width="110" style="border-bottom: 1.5px solid;"></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<br>
						<table width="100%">
							<tbody>
								<tr>
									<td></td>
									<td width="100" class="text-right"><b>Date</b></td>
									<td width="200" style="border-bottom: 1.5px solid;"></td>
								</tr>
							</tbody>
						</table>
					</div>
					';
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