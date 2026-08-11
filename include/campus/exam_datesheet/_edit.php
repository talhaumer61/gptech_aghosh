<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '82', 'edit' => '1'))){
//-----------------------------------------------------
$sqllms_datesheet	= $dblms->querylms("SELECT id, status, id_exam, id_session, id_class, id_section
												FROM ".DATESHEET."				   
												WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
												AND id = '".cleanvars($_GET['id'])."' LIMIT 1");
$value_edit = mysqli_fetch_array($sqllms_datesheet);
//-----------------------------------------------------
echo '
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam_datesheet.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-edit"></i> Edit Datesheet</h4>
				</div>
				
				<div class="panel-body">
					<div class="row mt-sm">
						<div class="col-md-4 col-md-offset-2">
							<label class="control-label">Exam <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_exam" required title="Must Be Required" >
								<option value="">Select</option>';
									$sqllmsexam	= $dblms->querylms("SELECT type_id, type_status, type_name 
														FROM ".EXAM_TYPES."
														WHERE type_status = '1' 
														ORDER BY type_id ASC");
									while($valueexam = mysqli_fetch_array($sqllmsexam)) {
										if($valueexam['type_id'] == $value_edit['id_exam']){
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
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" required title="Must Be Required" >
								<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
														FROM ".CLASSES."
														WHERE class_status = '1' 
														ORDER BY class_id ASC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										if($valuecls['class_id'] == $value_edit['id_class']){
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
								<input type="radio" id="status" name="status" value="1"'; if($value_edit['status'] == 1){ echo'checked'; } echo'>
								<label for="radioExample1">Yes</label>
							</div>
							<div class="radio-custom radio-inline mb-xs">
								<input type="radio" id="status" name="status" value="2"'; if($value_edit['status'] == 2){ echo'checked'; } echo'>
								<label for="radioExample2">No</label>
							</div>
						</div>
					</div>
				
					<div id="checkboxes">';
						//---------- Select Min Max date ------------------
						$sqllms	= $dblms->querylms("SELECT  date_start, date_end
													FROM ".EXAM_CALENDER_DETAIL." 
													WHERE id_type = '".$value_edit['id_exam']."' ");
						$rowsvalues = mysqli_fetch_array($sqllms);
						//-----------------------------------------------------
						$min = $rowsvalues['date_start']."<br>";
						$max = $rowsvalues['date_end'];
						//-----------------------------------------------------

						//------------------------------------------------
						$sqllmssubjects  = $dblms->querylms("SELECT COUNT(subject_id) as subjects
																FROM ".CLASS_SUBJECTS."  
																WHERE subject_status = '1' AND is_deleted != '1'
																AND id_class = '".$value_edit['id_class']."' ");
						//--------------------------------------------------
						if (mysqli_num_rows($sqllmssubjects) > 0) {

							$rowsubject = mysqli_fetch_array($sqllmssubjects);
							//------------------------------------------------

							for($i=1; $i<=$rowsubject['subjects']; $i++)
							{
								//------------------------------------------------
								
								$sqllmsdetail = $dblms->querylms("SELECT  id_subject, id_room, id_teacher, dated, start_time, end_time  
																		FROM ".DATESHEET_DETAIL." 
																		WHERE id_setup = '".cleanvars($_GET['id'])."' 
																		AND paper_no = '".$i."'LIMIT 1");
								$valuedetail = mysqli_fetch_array($sqllmsdetail);

								//------------------------------------------------
								if($valuedetail['dated'])
								{
									$dated = $valuedetail['dated'];
									// $dated = date("m/d/Y", strtotime($valuedetail['dated']));
								}
								else{
									echo $dated = "";
								}
								//------------------------------------------------

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
																						WHERE subject_status = '1' AND id_class = '".$value_edit['id_class']."'
																						ORDER BY subject_name ASC");
															while($rowsvalues = mysqli_fetch_array($sqllms)){
																if($rowsvalues['subject_id'] == $valuedetail['id_subject']){
																	echo'<option value="'.$rowsvalues['subject_id'].'" selected>'.$rowsvalues['subject_name'].' ('.$rowsvalues['subject_code'].')</option>';
																}else{
																	echo'<option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].' ('.$rowsvalues['subject_code'].')</option>';
																}
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
																							ORDER BY emply_name ASC");
																while($rowsvalues = mysqli_fetch_array($sqllms)){
																	if($rowsvalues['emply_id'] == $valuedetail['id_teacher']){
																		echo'<option value="'.$rowsvalues['emply_id'].'" selected>'.$rowsvalues['emply_name'].'</option>';
																	}else{
																		echo'<option value="'.$rowsvalues['emply_id'].'" >'.$rowsvalues['emply_name'].'</option>';
																	}
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
																if($rowsvalues['room_id'] == $valuedetail['id_room']){
																	echo'<option value="'.$rowsvalues['room_id'].'" selected>'.$rowsvalues['room_no'].'</option>';
																}else{
																	echo'<option value="'.$rowsvalues['room_id'].'">'.$rowsvalues['room_no'].'</option>';
																}
															}
															echo'
														</select>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-md-4 form-group">
														<label class="control-label">Date </label>
														<!-- <input type="text" class="form-control" name="dated['.$i.']" id="dated" value="'.$dated.'" data-plugin-datepicker/> -->
														<input type="date" class="form-control" name="dated['.$i.']" value="'.$dated.'" min="'.$min.'" max="'.$max.'"/> 
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Time From </label>
														<input type="text" class="form-control" name="start_time['.$i.']" id="start_time" value="'.$valuedetail['start_time'].'" data-plugin-timepicker/>
													</div>
													<div class="col-md-4 form-group">
														<label class="control-label">Time To </label>
														<input type="text" class="form-control" name="end_time['.$i.']" id="end_time" value="'.$valuedetail['end_time'].'" data-plugin-timepicker/>
													</div>
												</div>


										</div>
									</div> 
								</div>';
							}
							//----------------------------
						}
						else
						{
							echo'<h3 class="center danger">No Subject Found!</h3>';
						} 
						//----------------------------
						echo '
					</div>
				</div>
				<footer class="panel-footer mt-sm">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" id="change_datesheet" name="change_datesheet" class="mr-xs btn btn-primary">Update Datesheet</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>
</div>';
}else{
	header("Location: exam_datesheet.php");
}
?>