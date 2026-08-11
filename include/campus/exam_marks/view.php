<?php

// POST data
if(isset($_POST['id_type'])) { $examtype = $_POST['id_type']; } else { $examtype = '';}
if(isset($_POST['id_class'])) { $class = $_POST['id_class']; } else { $class = '';} 
if(isset($_POST['id_section'])) { $section = $_POST['id_section']; } else { $section = ''; }	

echo'
<section class="panel panel-featured panel-featured-primary">
	<form action="exam_marks.php" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-list"></i> Exam Marks </h2>
		</header>
		<div class="panel-body">
			<div class="row mb-lg">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Exam <span class="required">*</span></label>
						<select name="id_type" data-plugin-selectTwo data-width="100%" id="id_type" required title="Must Be Required" class="form-control populate">
						<option value="">Select</option>';
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
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Class <span class="required">*</span></label>
						<select name="id_class" data-plugin-selectTwo data-width="100%" id="id_class" required title="Must Be Required" class="form-control populate" onchange="get_classsection(this.value)">
							<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																FROM ".CLASSES."
																WHERE class_status = '1' AND is_deleted != '1'
																ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'"'; if($valuecls['class_id'] == $class){ echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				<div id="getclasssection">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Section <span class="required">*</span></label>
							<select name="id_section" data-plugin-selectTwo data-width="100%" id="id_section" required title="Must Be Required" class="form-control populate">
								<option value="">Select</option>';
								$sqllmsSec	= $dblms->querylms("SELECT section_id, section_name 
																	FROM ".CLASS_SECTIONS."
																	WHERE section_status = '1' AND is_deleted != '1'
																	AND id_class = '".$class."'
																	ORDER BY section_id ASC");
								while($valueSec = mysqli_fetch_array($sqllmsSec)) {
									echo '<option value="'.$valueSec['section_id'].'"'; if($valueSec['section_id'] == $section){ echo'selected';} echo'>'.$valueSec['section_name'].'</option>';
								}
								echo'
							</select>
						</div>
					</div>
				</div>
			</div>
			<center>
				<button type="submit" name="exam_marks" id="exam_marks" class="btn btn-primary"><i class="fa fa-search"></i> Show Result</button>
			</center>
		</div>
	</form>
</section>

<section class="panel panel-featured panel-featured-primary appear-animation mt-sm" data-appear-animation="fadeInRight" data-appear-animation-delay="100">';
    if(isset($_POST['exam_marks'])){
		echo'
		<header class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-bar-chart-o"></i> 
			Students Progress Report of '.$class.'</h2>
		</header>
		<div class="panel-body">
			<div class="table-responsive mt-sm mb-md">
				<table class="table table-bordered table-striped table-condensed  mb-none" id="my_table">
					<thead>
						<tr>
							<th class="center" width:"40">#</th>
							<th>
								Students <i class="fa fa-hand-o-down"></i> |
								Subjects <i class="fa fa-hand-o-right"></i>
							</th>';
							//-----------------------------------------
							$sqllmsSub	= $dblms->querylms("SELECT subject_id, subject_name, subject_totalmarks, subject_passmarks
																FROM ".CLASS_SUBJECTS."
																WHERE id_class = '".$class."' AND subject_status = '1' AND is_deleted != '1' ");
							//-----------------------------------------------------
							$subjectarray = array();
							while($rowSub = mysqli_fetch_array($sqllmsSub)){ 
								$subjectarray[] = $rowSub;
								echo'<th>'.$rowSub['subject_name'].'</th>';
							}
							echo'
							<th>Total Marks</th>
							<th>Obtained Marks</th>	
							<th>Percentage</th>
							<th>Status </th>
							<th width="40">Options </th>
						</tr>
					</thead>
					<tbody>';	
						// Students 
						$sqllmsStd = $dblms->querylms("SELECT std_id, std_name, std_fathername, std_status, id_class, id_campus
															FROM ".STUDENTS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															AND std_status = '1' AND is_deleted != '1' 
															AND id_class = '".$class."' AND id_section = '".$section."'");
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
																		INNER JOIN ".EXAM_MARKS." e ON e.id = ed.id_setup 
																		WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																		AND e.id_class = '".$class."' AND e.id_section = '".$section."'
																		AND e.id_subject = '".$listsub['subject_id']."'
																		AND ed.id_std = '".$valueStd['std_id']."' ");
									if(mysqli_num_rows($sqllmsmarks) > 0) {
										$rowmarks = mysqli_fetch_array($sqllmsmarks);
										echo '<td>'.$rowmarks['obtain_marks'].'</td>';

										$totalmarks = ($totalmarks + $rowmarks['max_marks']);
										$obtmarks = ($obtmarks + $rowmarks['obtain_marks']);
									} else {
										$totalmarks = $totalmarks;
										$obtmarks = $obtmarks;
										echo '<td></td>';
									}
								}

								$obtmarks.$totalmarks;
								// $permarks = round((($obtmarks/$totalmarks) * 100), 2);
								$permarks = 50;
								
								echo '
								<td>'.$totalmarks.'</td>
								<td>'.$obtmarks.'</td>
								<td class="hidden-xs hidden-sm center">
									<div class="progress progress-lg progress-squared light" style="margin: 6px;">
										<div class="progress-bar" role="progressbar" aria-valuenow="'.$permarks.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$permarks.'%;">
												'.$permarks.' %
										</div>
									</div>
								</td>
								<td>Pass/Fail</td>
								<td>
									<a href="include/marks/marks_sheetprint.php" class="btn btn-primary btn-xs" target="include/marks/marks_sheetprint.php">
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
		<div class="panel-footer">
			<div class="text-right">
				<a href="include/marks/marks_sheetprint.php" class="btn btn-sm btn-primary " target="include/marks/marks_sheetprint.php">
					<i class="glyphicon glyphicon-print"></i> Print
				</a>
			</div>
		</div>';
	}
	echo'
</section>';
?>