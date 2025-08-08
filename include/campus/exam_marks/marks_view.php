<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '14', 'view' => '1'))){
	// POST data
	if(isset($_POST['id_type'])) { $examtype = $_POST['id_type']; } else { $examtype = '';}
	if(isset($_POST['id_classlevel'])) { $id_classlevel = $_POST['id_classlevel']; } else { $id_classlevel = '';} 
	if(isset($_POST['id_class'])) { $class = $_POST['id_class']; } else { $class = '';}
	if(isset($_POST['id_campus'])) { $id_campus = $_POST['id_campus']; } else { $id_campus = $_SESSION['userlogininfo']['LOGINCAMPUS'];} 

	$section = '';
	$std_gender = '';
	$subjects = '';
	$id_subject = '';
	$sqlStdSection = '';
	$sqlSection = '';
	$sqlGender = '';
	$id_teacher = '';
	$sqlSubject = '';
	$sqlSection_t = '';
	$sqlMarksSubject = '';
	$sqlMarksSubject_s = '';
	
	// SECTION
	if($_POST['id_section']){		
		$section = $_POST['id_section'];
		$sqlStdSection = "AND s.id_section = '".$section."'";
		$sqlSection = "AND m.id_section = '".$section."'";
		$sqlSection_t = "AND t.id_section = '".$section."'";
	}

	// GENDER
	if($_POST['std_gender']){
		$std_gender = $_POST['std_gender'];
		$sqlGender = "AND s.std_gender = '".$std_gender."'";
	}

	// TEACHER
	if($_POST['id_teacher']){
		$aray 				= explode("|", $_POST['id_teacher']);
		$id_teacher			= $aray[0];
		$subjects			= $aray[2];
		$sqlSubject			= "AND subject_id IN ($subjects)";
		$sqlMarksSubject	= "AND m.id_subject IN ($subjects)";
		$sqlMarksSubject_s	= "AND s.subject_id IN ($subjects)";

		// SUBJECT
		if($_POST['id_subject']){
			$id_subject = $_POST['id_subject'];
			$sqlSubject = "AND subject_id = '".$id_subject."'";
			$sqlMarksSubject = "AND m.id_subject = '".$id_subject."'";
			$sqlMarksSubject_s = "AND s.subject_id = '".$id_subject."'";
		}
	}

	echo'
	<section class="panel panel-featured panel-featured-primary">
		<form action="exam_marks.php?view=view" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-list"></i> Exam Marks </h2>
			</header>
			<div class="panel-body">
				<div class="row mb-lg">
					<!--
					<div class="col-md-4 mt-sm">
						<label class="control-label">Campus <span class="required">*</span></label>
						<select data-plugin-selectTwo data-width="100%" name="id_campus" id="id_campus" required title="Must Be Required" class="form-control populate">
							<option value="">Select</option>';
							$sqllmscampus	= $dblms->querylms("SELECT c.campus_id, c.campus_name
																FROM ".CAMPUS." c  
																WHERE c.campus_id != '' AND campus_status = '1'
																ORDER BY c.campus_id ASC");
							while($value_campus = mysqli_fetch_array($sqllmscampus)){
								echo'<option value="'.$value_campus['campus_id'].'" '.($value_campus['campus_id']==$id_campus ? 'selected' : '').'>'.$value_campus['campus_name'].' - '.$value_campus['campus_id'].'</option>';
							}
							echo'
						</select>
					</div>-->
					<div class="col-md-6 mt-sm">
						<label class="control-label">Exam <span class="required">*</span></label>
						<select name="id_type" data-plugin-selectTwo data-width="100%" id="id_type" required title="Must Be Required" class="form-control populate">
							<option value="">Select</option>
							<option value="all" '.($examtype=='all' ? 'selected' : '').'>All</option>';
								$sqllmsexam	= $dblms->querylms("SELECT type_id, type_status, type_name 
													FROM ".EXAM_TYPES."
													WHERE type_status = '1' AND is_deleted != '1'
													ORDER BY type_id ASC");
								while($valueexam = mysqli_fetch_array($sqllmsexam)) {
									echo '<option value="'.$valueexam['type_id'].'"'; if($valueexam['type_id'] == $examtype){echo'selected';} echo'>'.$valueexam['type_name'].'</option>';
								}
							echo'
						</select>
					</div>
					<div class="col-md-6 mt-sm">
						<label class="control-label">Class <span class="required">*</span></label>
						<select name="id_class" data-plugin-selectTwo data-width="100%" id="id_class" required title="Must Be Required" class="form-control populate">
							<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																FROM ".CLASSES."
																WHERE class_status = '1' AND is_deleted != '1'
																ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)){
								echo '<option value="'.$valuecls['class_id'].'" '.($valuecls['class_id']==$class ? 'selected' : '').'>'.$valuecls['class_name'].'</option>';
							}
							echo'
						</select>
					</div>
					<!--
					<div class="col-md-3 mt-sm">
						<label class="control-label">Level </label>
						<select data-plugin-selectTwo data-width="100%" name="id_classlevel" id="id_classlevel" title="Must Be Required" class="form-control populate" onchange="get_classlevel(this.value)">
							<option value="">Select</option>';
							foreach ($classlevel as $level):
								echo'<option value="'.$level['id'].'" '.($id_classlevel==$level['id'] ? 'selected' : '').'>'.$level['name'].'</option>';
							endforeach;
							echo'
						</select>
					</div>

					<div id="get_class_sectionteacher">
						<div class="col-md-3 mt-sm">
							<label class="control-label">Section </label>
							<select name="id_section" data-plugin-selectTwo data-width="100%" id="id_section" title="Must Be Required" class="form-control populate">
								<option value="">Select</option>';
								$sqllmsSec	= $dblms->querylms("SELECT section_id, section_name 
																	FROM ".CLASS_SECTIONS."
																	WHERE section_status = '1' AND is_deleted != '1'
																	AND id_class = '".$class."'
																	AND id_campus = '".$id_campus."'
																	ORDER BY section_id ASC");
								while($valueSec = mysqli_fetch_array($sqllmsSec)) {
									echo '<option value="'.$valueSec['section_id'].'"'; if($valueSec['section_id'] == $section){ echo'selected';} echo'>'.$valueSec['section_name'].'</option>';
								}
								echo'
							</select>
						</div>
						<div class="col-md-3 mt-sm">
							<label class="control-label">Teacher </label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" id="id_teacher" name="id_teacher">
								<option value="">Select</option>';
								$sqlTecher	= $dblms->querylms("SELECT GROUP_CONCAT(DISTINCT(td.id_subject)) as subjects, td.id_teacher, e.emply_name
																	FROM ".TIMETABLE." t
																	INNER JOIN ".TIMETABEL_DETAIL." td ON td.id_setup = t.id
																	INNER JOIN ".EMPLOYEES." e ON e.emply_id = td.id_teacher
																	WHERE t.status = '1' AND t.is_deleted = '0'
																	AND t.id_class = '".$class."'
																	$sqlSection_t
																	AND t.id_campus = '".$id_campus."'
																	GROUP BY td.id_teacher
																");
								while($valTeacher = mysqli_fetch_array($sqlTecher)) {
									echo '<option value="'.$valTeacher['id_teacher'].'|'.$class.'|'.$valTeacher['subjects'].'" '.($valTeacher['id_teacher']==$id_teacher ? 'selected' : '').'>'.$valTeacher['emply_name'].'</option>';
								}
								echo'
							</select>
						</div>
					</div>

					<div class="col-sm-3 mt-sm">
						<label class="control-label">Subject </label>
						<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" id="id_subject" name="id_subject">
							<option value="">Select</option>';
							if($_POST['syllabus_breakdown'] == "syllabus_breakdown"){echo'<option value="0">All Subjects</option>';}
							$sqlSubjects	= $dblms->querylms("SELECT td.id_subject, s.subject_code, s.subject_name
															FROM ".TIMETABLE." t
															INNER JOIN ".TIMETABEL_DETAIL." td ON td.id_setup = t.id
															INNER JOIN ".CLASS_SUBJECTS." s ON s.subject_id = td.id_subject 
															WHERE t.id_class		= '".cleanvars($class)."' 
															AND td.id_teacher		= '".cleanvars($id_teacher)."'
															AND s.subject_status	= '1'
															AND s.is_deleted		= '0'
															GROUP BY s.subject_id ASC");
							while($valSubject = mysqli_fetch_array($sqlSubjects)) {
								echo '<option value="'.$valSubject['id_subject'].'" '.($valSubject['id_subject']==$id_subject ? 'selected' : '').'>'.$valSubject['subject_code'].' - '.$valSubject['subject_name'].'</option>';
							}
							echo'
						</select>
					</div>
					<div class="col-md-3 mt-sm">
						<label class="control-label">Gender </label>
						<select class="form-control" data-plugin-selectTwo data-width="100%" id="std_gender" name="std_gender">
							<option value="">Select</option>';
							foreach($gender as $gndr){
								echo '<option value="'.$gndr.'" '.($std_gender==$gndr ? 'selected' : '').'>'.$gndr.'</option>';
							}
							echo'
						</select>
					</div>
					-->
				</div>
				<center>
					<button type="submit" name="exam_marks" id="exam_marks" class="btn btn-primary mr-xn"><i class="fa fa-search"></i> Show Result</button>
					<button type="submit" name="print_exam_marks" id="print_exam_marks" class="btn btn-primary"><i class="fa fa-print"></i> Print Result</button>
				</center>
			</div>
		</form>
	</section>';


	if(isset($_POST['exam_marks'])){
		if($examtype=='all'){
			$sqllmsResult = $dblms->querylms("SELECT	s.std_id, s.std_name, s.std_fathername,
														GROUP_CONCAT(DISTINCT t.type_name) as examtype,
														SUM(d.obtain_marks) as total_obtained,
														SUM(m.total_marks) as total_marks, m.id_class, m.id_section, m.id_session, m.id_campus
												FROM ".EXAM_MARKS_DETAILS." d
												INNER JOIN ".EXAM_MARKS."	m ON m.id		=	d.id_setup
												INNER JOIN ".STUDENTS."		s ON (
													s.std_id = d.id_std
													AND s.id_deleted	= '0'
													AND s.id_session	= '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
													AND s.id_class		= '".$class."' 
												)
												INNER JOIN ".EXAM_TYPES."	t ON t.type_id	=	m.id_exam
												WHERE m.id_campus	= '".$id_campus."'
												AND m.id_session	= '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
												AND m.id_class		= '".$class."' 
												$sqlSection $sqlMarksSubject $sqlGender
												AND m.is_deleted	= '0'
												GROUP BY s.std_id
												");
			$srno = 0;
			if(mysqli_num_rows($sqllmsResult)>0){
				echo'
				<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
					<header class="panel-heading">
						<a type="button" id="export_button" class="btn btn-primary btn-xs pull-right"><i class="fa fa-file-excel-o"></i> Export Excel</a>
						<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i>Students Progress Report </h2>	
					</header>
					<div class="panel-body">
						<div class="table-responsive mt-sm mb-md">
							<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
								<thead>
									<tr>
										<th class="center" width="10">#</th>
										<th>Students</th>
										<th>Terms</th>	
										<th>Percentage</th>
										<th width="40">Options</th>
									</tr>
								</thead>
								<tbody>';
									while($valueResult = mysqli_fetch_array($sqllmsResult)){
										$srno++;
										$total_marks = $valueResult['total_marks'];
										$total_obtained = $valueResult['total_obtained'];
										$percentage = round((($total_obtained / $total_marks) * 100), 2);
										echo'
										<tr>
											<td class="center">'.$srno.'</td>
											<td>'.$valueResult['std_name'].' '.$valueResult['std_fathername'].'</td>
											<td>'.$valueResult['examtype'].'</td>
											<td>'.$percentage.' %</td>
											<td class="text-center">
												<a href="single_marksheetprint.php?std_id='.$valueResult['std_id'].'&id_type='.$examtype.'&id_class='.$class.'&id_section='.$section.'&id_subject='.$id_subject.'&id_campus='.$id_campus.'&id_session='.$_SESSION['userlogininfo']['EXAM_SESSION'].'" class="btn btn-primary btn-xs" target="_blank">
													<i class="fa fa-print"></i>
												</a>
											</td>
										</tr>';
									}
									echo'	
								</tbody>
							</table>
						</div>
					</div>
					<!-- <div class="panel-footer">
						<div class="text-right">
							<a href="" target="_blank" class="btn btn-sm btn-primary">
								<i class="glyphicon glyphicon-print"></i> Print
							</a>
						</div>
					</div> -->
				</section>';
			}else{
				echo'
				<section class="panel panel-featured panel-featured-primary appear-animation mt-sm fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
					<h2 class="panel-body text-center font-bold mt-none text text-danger">No Record Found</h2>
				</section>';
			}
		}else{
			$sqllmsChk	= $dblms->querylms("SELECT id
											FROM ".EXAM_MARKS." m
											WHERE m.id_exam = '".cleanvars($examtype)."'
											AND m.id_class = '".cleanvars($class)."'
											$sqlSection
											AND m.is_deleted = '0'
											AND m.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
											AND m.id_campus = '".$id_campus."' 
											LIMIT 1");
			if(mysqli_num_rows($sqllmsChk)){
				echo'
				<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">
					<header class="panel-heading">
						<a type="button" id="export_button" class="btn btn-primary btn-xs pull-right"><i class="fa fa-file-excel-o"></i> Export Excel</a>
						<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i>  Students Progress Report </h2>
					</header>
					<div class="panel-body">
						<div class="table-responsive mt-sm mb-md">
							<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
								<thead>
									<tr>
										<th class="center" width="10">#</th>
										<th>
											Students <i class="fa fa-hand-o-down"></i> |
											Subjects <i class="fa fa-hand-o-right"></i>
										</th>';
										//-----------------------------------------
										$sqllmsSub	= $dblms->querylms("SELECT subject_id, subject_name
																			FROM ".CLASS_SUBJECTS."
																			WHERE id_class		= '".$class."'
																			$sqlSubject
																			AND subject_status	= '1'
																			AND is_deleted		= '0' ");
										//-----------------------------------------------------
										$subjectarray = array();
										while($rowSub = mysqli_fetch_array($sqllmsSub)){ 
											$subjectarray[] = $rowSub;
											echo'<th class="center" width="100">'.$rowSub['subject_name'].'</th>';
										}
										echo'
										<th class="center" width="100">Total Marks</th>
										<th class="center" width="100">Obtained Marks</th>	
										<th class="center" width="300">Percentage</th>
										<th class="center" width="40">Options </th>
									</tr>
								</thead>
								<tbody>';
									// Students
									$sqllmsStd = $dblms->querylms("SELECT s.std_id, s.std_name, s.std_fathername, s.std_status, s.id_class, s.id_campus
																		FROM ".STUDENTS." s
																		WHERE s.id_campus = '".$id_campus."'
																		AND s.std_status = '1' AND s.is_deleted != '1'
																		AND s.id_class = '".$class."' $sqlStdSection $sqlGender");
									$srno = 0;
									while($valueStd = mysqli_fetch_array($sqllmsStd)){	
										$srno++;	
										$totalmarks = 0;
										$obtmarks = 0;
										$permarks = 0;
										echo'
										<tr>
											<td class="center">'.$srno.'</td>
											<td>'.$valueStd['std_name'].' '.$valueStd['std_fathername'].'</td>';
											foreach($subjectarray as $listsub) {
												$sqllmsmarks = $dblms->querylms("SELECT *
																					FROM ".EXAM_MARKS_DETAILS." ed 
																					INNER JOIN ".EXAM_MARKS." m ON m.id = ed.id_setup 
																					WHERE m.id_campus = '".$id_campus."'
																					AND m.id_class = '".$class."'
																					$sqlSection
																					AND m.id_session = '".$_SESSION['userlogininfo']['EXAM_SESSION']."'
																					AND m.id_subject = '".$listsub['subject_id']."'
																					AND m.id_exam = '".$examtype."'
																					AND ed.id_std = '".$valueStd['std_id']."' ");
												if(mysqli_num_rows($sqllmsmarks) > 0) {
													$rowmarks = mysqli_fetch_array($sqllmsmarks);
													echo '<td class="center">'.$rowmarks['obtain_marks'].'/'.$rowmarks['total_marks'].'</td>';

													$totalmarks = ($totalmarks + $rowmarks['total_marks']);
													$obtmarks = ($obtmarks + $rowmarks['obtain_marks']);
												} else {
													$totalmarks = $totalmarks;
													$obtmarks = $obtmarks;
													echo '<td></td>';
												}
											}

											$permarks = round((($obtmarks/$totalmarks) * 100), 2);
											
											echo '
											<td class="center">'.$totalmarks.'</td>
											<td class="center">'.$obtmarks.'</td>
											<td class="hidden-xs hidden-sm center">
												<div class="progress progress-lg progress-squared light" style="margin: 6px;">
													<div class="progress-bar" role="progressbar" aria-valuenow="'.$permarks.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$permarks.'%;">
															'.$permarks.' %
													</div>
												</div>
											</td>
											<td class="text-center">
												<a href="single_marksheetprint.php?std_id='.$valueStd['std_id'].'&id_type='.$examtype.'&id_class='.$class.'&id_section='.$section.'&id_subject='.$id_subject.'&id_campus='.$id_campus.'&id_session='.$_SESSION['userlogininfo']['EXAM_SESSION'].'" class="btn btn-primary btn-xs" target="_blank">
													<i class="fa fa-print"></i>
												</a>
											</td>
										</tr>';
									}
									echo'	
								</tbody>
							</table>
						</div>
					</div>
					<!-- <div class="panel-footer">
						<div class="text-right">
							<a href="" target="_blank" class="btn btn-sm btn-primary">
								<i class="glyphicon glyphicon-print"></i> Print
							</a>
						</div>
					</div> -->
				</section>';
			}else{
				echo'
				<section class="panel panel-featured panel-featured-primary appear-animation mt-sm fadeInRight appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="100" style="animation-delay: 100ms;">
					<h2 class="panel-body text-center font-bold mt-none text text-danger">No Record Found</h2>
				</section>';
			}
		}
	}elseif(isset($_POST['print_exam_marks'])){
		include('marks_sheetprint.php');
	}
}else{
	header("Location: dashboard.php");
}
?>