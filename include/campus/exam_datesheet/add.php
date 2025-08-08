<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'add' => '1'))){
	//-----------------------------------------------
	if(isset($_POST['id_exam'])){$exam = $_POST['id_exam'];}else{$exam = "";}
	if(isset($_POST['id_class'])){$class = $_POST['id_class'];}else{$class = "";}
	if(isset($_POST['status'])){$status = $_POST['status'];}else{$status = "";}
	//-----------------------------------------------
	echo '
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-list"></i> Select</h4>
				</div>
				<div class="panel-body">
					<div class="row mt-sm">
						<div class="col-md-4 col-md-offset-2">
							<label class="control-label">Exam <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_exam" required title="Must Be Required" >
								<option value="">Select</option>';
								$sqllmsexam	= $dblms->querylms("SELECT t.type_id, t.type_status, t.type_name 
																FROM ".EXAM_TYPES." t
																WHERE t.type_status = '1' 
																AND t.is_deleted = '0'
																ORDER BY t.type_id ASC
															");
								while($valueexam = mysqli_fetch_array($sqllmsexam)) {
									if($valueexam['type_id'] == $exam){
										echo '<option value="'.$valueexam['type_id'].'" selected>'.$valueexam['type_name'].'</option>';
									}else{
										echo '<option value="'.$valueexam['type_id'].'">'.$valueexam['type_name'].'</option>';
									}
								}
								echo '
							</select>
						</div>
						<div class="col-md-4">
							<label class="control-label">Class <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class"  required title="Must Be Required" >
								<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
														FROM ".CLASSES."
														WHERE class_status = '1' AND is_deleted != '1'
														ORDER BY class_id ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										if($valuecls['class_id'] == $class){
											echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
										}else{
											echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
										}
								}
							echo '
							</select>
						</div>
					</div>				  
					<div class="form-group">
						<label class="col-md-1 col-md-offset-2 control-label mt-lg">Publish <span class="required">*</span></label>
						<div class="col-md-8 mt-lg">
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Yes</label>
							</div>
							<div class="radio-custom radio-inline mb-xs">
								<input type="radio" id="status" name="status" value="2">
								<label for="radioExample2">No</label>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-center">';
						if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'add' => '1'))){ 	
							echo'
							<button type="submit" id="view_details" name="view_details" class="mr-xs btn btn-primary">Get Details</button>';
						}
						echo'
						</div>
					</div>
				</footer>
				</form>
			</section>
		</div>
	</div>
	';

	if(isset($_POST['view_details'])){
		//-----------------------------------------------------
		$sqllms	= $dblms->querylms("SELECT  d.date_start, d.date_end
									FROM ".EXAM_CALENDER_DETAIL." d
									INNER JOIN ".EXAM_CALENDER." c ON c.id = d.id_setup
									WHERE d.id_type = '".$exam."' 
									AND c.id_session = '".cleanvars($_SESSION['userlogininfo']['EXAM_SESSION'])."' ");
		$rowsvalues = mysqli_fetch_array($sqllms);
		//-----------------------------------------------------
		$min = $rowsvalues['date_start'];
		$max = $rowsvalues['date_end'];
		//-----------------------------------------------------
		echo'
		<div class="row">
			<div class="col-md-12">
				<section class="panel panel-featured panel-featured-primary">
					<form action="exam_datesheet.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Datesheet</h4>
						</div>
						<div class="panel-body">
							<div id="checkboxes">';
								$sqllmssubjects  = $dblms->querylms("SELECT subject_id
																		FROM ".CLASS_SUBJECTS."  
																		WHERE subject_status = '1' AND is_deleted != '1'
																		AND id_class = '".$class."' ");
								$subjectFlag = false;
								if (mysqli_num_rows($sqllmssubjects) != 0) {
									$sqllmssubjects  = $dblms->querylms("SELECT COUNT(subject_id) as subjects
																		FROM ".CLASS_SUBJECTS."  
																		WHERE subject_status = '1' AND is_deleted != '1'
																		AND id_class = '".$class."' ");
									$rowsubject = mysqli_fetch_array($sqllmssubjects);
									$subjectFlag = true;
									for($i=1; $i<=$rowsubject['subjects']; $i++) {
										echo '
										<div class="col-sm-41">
											<div class="form_sep" style="margin-top:10px;">
											<div class="col-sm-6" style="padding:10px;">
												<label><b style="color: #cb3f44">Paper: '.$i.'</b></label><br>
												<input type="hidden" name="paper_no['.$i.']" value="'.$i.'">
												<div class="col-sm-12">
													<div class="col-md-4 form-group">
														<label class="control-label">Subject </label>
														<select data-plugin-selectTwo data-width="100%" name="id_subject['.$i.']" id="id_subject" title="Must Be Required" class="form-control populate" >
															<option value="">Select</option>';
															$sqllms	= $dblms->querylms("SELECT subject_id, subject_name, subject_code
																						FROM ".CLASS_SUBJECTS." 
																						WHERE subject_status = '1' AND id_class = '".$class."'
																						ORDER BY subject_name ASC");
															while($rowsvalues = mysqli_fetch_array($sqllms)){
															echo'<option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].' ('.$rowsvalues['subject_code'].')</option>';
															}
															echo'
														</select>
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Invigilator </label>
														<select data-plugin-selectTwo data-width="100%" name="id_teacher['.$i.']" id="id_teacher" title="Must Be Required" class="form-control populate" >
															<option value="">Select</option>';
															$sqllms	= $dblms->querylms("SELECT emply_id, emply_name
																							FROM ".EMPLOYEES." 
																							WHERE emply_status = '1' AND id_type = '1'
																							AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																							AND is_deleted = '0'
																							ORDER BY emply_name ASC");
																while($rowsvalues = mysqli_fetch_array($sqllms)){
																echo'<option value="'.$rowsvalues['emply_id'].'">'.$rowsvalues['emply_name'].'</option>';
																}
																echo'
														</select>
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Room </label>
														<select data-plugin-selectTwo data-width="100%" name="id_room['.$i.']" id="id_room" title="Must Be Required" class="form-control populate" >
															<option value="">Select</option>
															';
															$sqllms	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_no
																							FROM ".CLASS_ROOMS." r
																							WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																							AND r.room_status = '1'
																							ORDER BY r.room_no ASC");
															while($rowsvalues = mysqli_fetch_array($sqllms)){
																echo'
																<option value="'.$rowsvalues['room_id'].'">'.$rowsvalues['room_no'].'</option>
															';
															}
															echo'
														</select>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-md-4 form-group">
														<label class="control-label">Date </label>
														<!-- <input type="text" class="form-control" data-plugin-datepicker name="dated['.$i.']" id="" autocomplete="off" min="'.$min.'" max="'.$max.'"/>-->
														<input type="date" class="form-control" name="dated['.$i.']" min="'.($_SESSION['userlogininfo']['LOGINCAMPUS'] == '70' ? '' : $min ).'" max="'.($_SESSION['userlogininfo']['LOGINCAMPUS'] == '70' ? '' : $max ).'"/> 
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Time From </label>
														<input type="text" class="form-control" name="start_time['.$i.']" id="start_time" data-plugin-timepicker/>
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Time To </label>
														<input type="text" class="form-control" name="end_time['.$i.']" id="end_time" data-plugin-timepicker/>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-md-6 form-group">
														<label class="control-label">Total Marks </label>
														<input type="number" class="form-control" name="total_marks['.$i.']" id="total_marks"/>
													</div>
													<div class="col-md-6 form-group">
														<label class="control-label">Passing Marks </label>
														<input type="number" class="form-control" name="passing_marks['.$i.']" id="passing_marks"/>
													</div>
												</div>
											</div>
											</div> 
										</div>';
									}
									echo'
									<input type="hidden" name="exam" value="'.$exam.'">
									<input type="hidden" name="class" value="'.$class.'">
									<input type="hidden" name="status" value="'.$status.'">';
								} else {
									echo'<h3 class="center text-danger">Please Add Subject Firstly!</h3>';
								} 
								echo '
							</div>
						</div>';
						if ($subjectFlag) {
							echo'
							<footer class="panel-footer">
								<div class="row">
									<div class="col-md-12 text-right">
										<button type="submit" id="submit_datesheet" name="submit_datesheet" class="mr-xs btn btn-primary">Add Datesheet</button>
										<button type="reset" class="btn btn-default">Reset</button>
									</div>
								</div>
							</footer>';
						}
						echo'
					</form>
				</section>
			</div>
		</div>';
	}
} else {
	header("Location: exam_datesheet.php");
}
?>