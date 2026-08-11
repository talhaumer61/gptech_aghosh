<?php
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="timetable_periodsmake.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Periods</h4>
</div>
<div class="panel-body">
			<div class="row mt-sm">
				<div class="col-sm-6">
					  <div class="form-group">
						<label class="control-label">Class <span class="required">*</span></label>
						 <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
															FROM ".CLASSES."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															ORDER BY class_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
								}
							echo '
							</select>
					  </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label">Section <span class="required">*</span></label>
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
															FROM ".CLASS_SECTIONS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															ORDER BY section_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
								}
							echo '
							</select>
					</div>
				</div>
			</div>					  
			<div class="form-group">
				<label class="col-sm-2 control-label mt-lg">Status <span class="required">*</span></label>
				<div class="col-md-9 mt-lg">
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


<div id="checkboxes">';

$sri = 0;
$ji = 0;
$kij = 0;
$rolesarray = array();
$brolesarray = array();

// for looop	
foreach($daytypes as $day) {
//------------------------------------------------
	$sqllmsperiods  = $dblms->querylms("SELECT p.period_id, p.period_status, p.period_name
								   FROM ".PERIODS." p  
								   WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND p.period_status = '1'
								   ORDER BY p.period_name ASC");
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
	<div class="col-sm-4" style="padding:10px;">
			<input type="hidden" id="day['.$sri.']" name="day['.$sri.']" value="'.$day['id'].'">
			<input type="hidden" id="period_id['.$sri.']" name="id_period['.$sri.']" value="'.$rowperiods['period_id'].'">
			<label><b style="color: #cb3f44"> '.$rowperiods['period_name'].'</b></label><br>
			<div class="col-sm-12">
			<div class="col-md-4 form-group">
				<label class="control-label">Subject</label>
				<select data-plugin-selectTwo data-width="100%" name="id_subject['.$sri.']" id="id_subject['.$sri.']" title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT cs.subject_id, cs.subject_status, cs.subject_name
																FROM ".CLASS_SUBJECTS." cs  
																WHERE cs.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																AND cs.subject_status = '1'
																ORDER BY cs.subject_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									echo'
									   <option value="'.$rowsvalues['subject_id'].'">'.$rowsvalues['subject_name'].'</option>
								   ';
								   }
								   echo'
                             </select>
			</div>
			<div class="col-md-4 form-group">
				<label class="control-label">Teacher</label>
				<select data-plugin-selectTwo data-width="100%" name="id_emply['.$sri.']" id="id_emply['.$sri.']" title="Must Be Required" class="form-control populate">
								<option value="">Select</option>
								';
                                $sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.id_type, e.emply_name
																FROM ".EMPLOYEES." e 
																WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																AND e.id_type = '1' 
																ORDER BY e.emply_name ASC");
								   while($rowsvalues = mysqli_fetch_array($sqllms)){
									echo'
									   <option value="'.$rowsvalues['emply_id'].'">'.$rowsvalues['emply_name'].'</option>
								   ';
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
	</div>
		</div> 
	</div>';
}  // end while loop
//----------------------------
} // end if count
} // end foreach


//----------------------------
echo '
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
?>