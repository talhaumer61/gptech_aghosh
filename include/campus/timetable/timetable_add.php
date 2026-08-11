<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '9', 'add' => '1'))){
//-----------------------------------------------
if(isset($_POST['id_class'])){$class = $_POST['id_class'];}else{$class = "";}
if(isset($_POST['id_section'])){$section = $_POST['id_section'];}else{$section = "";}
if(isset($_POST['status'])){$status = $_POST['status'];}else{$status = "";}
//-----------------------------------------------
echo '
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Timetable</h4>
			</div>
			<div class="panel-body">
				<div class="row mt-sm">
					<div class="col-md-2"></div>
					<div class="col-md-4">
						<label class="control-label">Class <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" onchange="get_classsection(this.value)">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
													FROM ".CLASSES."
													WHERE class_id != '' AND class_status = '1' AND is_deleted != '1'
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
					<div id="getclasssection">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Section <span class="required">*</span></label>
								<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section" required>
									<option value="">Select</option>
								</select>
							</div>
						</div>
					</div>
				</div>			
				<div class="col-md-2"></div>		  
				<div class="form-group">
					<label class="col-md-1 control-label mt-lg">Status <span class="required">*</span></label>
					<div class="col-md-8 mt-lg">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer mt-sm">
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
</div>';

//------------ Check if record Already Exist ------------------
$sqllmscheck  = $dblms->querylms("SELECT id_session, id_class, id_section 
										FROM ".TIMETABLE." 
										WHERE id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
										AND id_session = '".cleanvars($_SESSION['userlogininfo']['ACADEMICSESSION'])."'
										AND id_class = '".cleanvars($class)."' 
										AND id_section = '".cleanvars($section)."'
										AND is_deleted != '1' LIMIT 1");
if(mysqli_num_rows($sqllmscheck) > 0) {
	$_SESSION['msg']['title'] 	= 'Error';
	$_SESSION['msg']['text'] 	= 'Record Already Exists';
	$_SESSION['msg']['type'] 	= 'error';
	header("Location: timetable.php?view=add", true, 301);
	exit();
} 

if(isset($_POST['view_details']) && mysqli_num_rows($sqllmscheck) == 0){
echo'
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="timetable.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Timetable</h4>
				</div>
				<div class="panel-body">
					<div id="checkboxes">';

					$sri = 0;
					$ji = 0;
					$kij = 0;
					$rolesarray = array();
					$brolesarray = array();

					// for looop	
					foreach($daytypes as $day) {
					if($day['id'] < 7) {
					//------------------------------------------------
						$sqllmsperiods  = $dblms->querylms("SELECT period_id, period_name
													FROM ".PERIODS." 
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND period_id != '' AND period_status = '1' AND is_deleted != '1'
													ORDER BY period_name ASC");
						//--------------------------------------------------
					if (mysqli_num_rows($sqllmsperiods) > 0) {
					$kij++;
					//------------------------------------------------
						echo '
						<div style="clear:both;"></div>
						<div class="col-lg-12 heading-modal mt-sm" style="background-color: #cb3f44; color: white; padding: 5px 10px; border-radius: 5px;">
							<b> '.$day['name'].'</b>
						</div>
						<div style="clear:both;"></div>';
					//------------------------------------------------
					while($rowperiods = mysqli_fetch_array($sqllmsperiods)) {
					$sri++;
					$ji++;
					//------------------------------------------------
					echo '
						<div class="col-sm-41">
							<div class="form_sep" style="margin-top:10px;">
						<div class="col-sm-6" style="padding:10px;">
								<input type="hidden" id="day['.$sri.']" name="day['.$sri.']" value="'.$day['id'].'">
								<input type="hidden" id="id_period['.$sri.']" name="id_period['.$sri.']" value="'.$rowperiods['period_id'].'">
								<label><b style="color: #cb3f44"> '.$rowperiods['period_name'].'</b></label><br>
								<div class="col-sm-12">
								<div class="col-md-4 form-group">
									<label class="control-label">Subject</label>
									<select data-plugin-selectTwo data-width="100%" name="id_subject['.$sri.']" id="id_subject['.$sri.']" title="Must Be Required" class="form-control populate">
										<option value="">Select</option>';
										$sqllms	= $dblms->querylms("SELECT subject_id, subject_name, subject_code
																	FROM ".CLASS_SUBJECTS." 
																	WHERE subject_status = '1' AND is_deleted != '1' AND id_class = '".$class."'
																	ORDER BY subject_name ASC");
										while($rowsvalues = mysqli_fetch_array($sqllms)){
										echo'<option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].' ('.$rowsvalues['subject_code'].')</option>';
										}
										echo'
									</select>
								</div>
								<div class="col-md-4 form-group">
									<label class="control-label">Teacher</label>
									<select data-plugin-selectTwo data-width="100%" name="id_emply['.$sri.']" id="id_emply['.$sri.']" title="Must Be Required" class="form-control populate">
										<option value="">Select</option>';
										$sqllms	= $dblms->querylms("SELECT emply_id, emply_name
																		FROM ".EMPLOYEES." 
																		WHERE emply_status = '1' AND is_deleted != '1' AND id_type = '1'
																		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																		ORDER BY emply_name ASC");
											while($rowsvalues = mysqli_fetch_array($sqllms)){
											echo'<option value="'.$rowsvalues['emply_id'].'">'.$rowsvalues['emply_name'].'</option>';
											}
											echo'
									</select>
								</div>
								<div class="col-md-4 form-group">
									<label class="control-label">Room</label>
									<select data-plugin-selectTwo data-width="100%" name="id_room['.$sri.']" id="id_room['.$sri.']" title="Must Be Required" class="form-control populate">			
										<option value="">Select</option>
										';
										$sqllms	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_no
																		FROM ".CLASS_ROOMS." r
																		WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																		AND r.room_status = '1' AND is_deleted != '1'
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
						</div>
							</div> 
						</div>';
					}  // end while loop
					//----------------------------
					} // end if count
					} // end days if
					} // end foreach


					//----------------------------
					echo '
					<input type="hidden" name="class" value="'.$class.'">
					<input type="hidden" name="section" value="'.$section.'">
					<input type="hidden" name="status" value="'.$status.'">
				</div>
				</div>
				<footer class="panel-footer mt-sm">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" id="submit_timetable" name="submit_timetable" class="mr-xs btn btn-primary">Add Timetable</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>
</div>';
}
//------------------------------------------
}
else{
	header("Location: timetable.php", true, 301);
}
?>