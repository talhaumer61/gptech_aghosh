<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '13', 'updated' => '1'))){
//-----------------------------------------------------
$sqllmstimetableedit	= $dblms->querylms("SELECT t.id, t.status, t.id_session, t.id_class, t.id_section,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name
								   FROM ".TIMETABLE." t
								   INNER JOIN ".CLASSES."  	 	 c 	ON 	c.class_id 		= t.id_class
								   INNER JOIN ".CLASS_SECTIONS." se	ON 	se.section_id 	= t.id_section					   
								   WHERE t.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND t.id = '".cleanvars($_GET['id'])."' LIMIT 1");
$value_edit = mysqli_fetch_array($sqllmstimetableedit);
//-----------------------------------------------------
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="timetable.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-edit"></i> Edit Timetable</h4>
</div>
<div class="panel-body">
			<div class="row mt-sm">
				<div class="col-sm-6">
					  <div class="form-group">
						<label class="control-label">Class <span class="required">*</span></label>
						 <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" onchange="get_classsection(this.value)">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
															FROM ".CLASSES."
															WHERE class_status = '1' 
															ORDER BY class_id ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'"'; if($valuecls['class_id']  == $value_edit['id_class']){echo ' selected';}echo'>'.$valuecls['class_name'].'</option>';
					  }
			  echo '
							</select>
					  </div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label">Section <span class="required">*</span></label>
							<div id="getclasssection">	
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
															FROM ".CLASS_SECTIONS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															AND section_status = '1' AND section_id = '".$value_edit['id_section']."'"); 
								$valuecls = mysqli_fetch_array($sqllmscls);
							  echo '<option value="'.$valuecls['section_id'].'" selected>'.$valuecls['section_name'].'</option>
							</select>
							</div>
					</div>
				</div>
			</div>					  
			<div class="form-group">
				<label class="col-sm-2 control-label mt-lg">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($value_edit['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Active</label>
					</div>

					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($value_edit['status'] == 2) {echo' checked';}echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>

<div id="checkboxes">';

$sri = 0;
$ji = 0;
$kij = 0;

// for looop	
foreach($daytypes as $day) {
//------------------------------------------------
	$sqllmsperiods  = $dblms->querylms("SELECT p.period_id, p.period_name
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
$sqllmsdetail  = $dblms->querylms("SELECT *    
										FROM ".TIMETABEL_DETAIL." d 
										WHERE d.id_period 	= '".cleanvars($rowperiods['period_id'])."' 
										AND d.day 			= '".cleanvars($day['id'])."' 
										AND d.id_setup 		= '".cleanvars($_GET['id'])."' LIMIT 1");
$valuedetail 		= mysqli_fetch_array($sqllmsdetail);
//------------------------------------------------
echo '
	<div class="col-sm-41">
		<div class="form_sep" style="margin-top:10px;">
	<div class="col-sm-6" style="padding:10px;">
			<input type="hidden" id="day['.$sri.']" name="day['.$sri.']" value="'.$day['id'].'">
			<input type="hidden" id="period_id['.$sri.']" name="id_period['.$sri.']" value="'.$rowperiods['period_id'].'">
			<label><b style="color: #cb3f44"> '.$rowperiods['period_name'].'</b></label><br>
			<div class="col-sm-12">
			<div class="col-md-4 form-group">
				<label class="control-label">Subject</label>
					<select data-plugin-selectTwo data-width="100%" name="id_subject['.$sri.']" id="id_subject['.$sri.']" title="Must Be Required" class="form-control populate">
							<option value="">Select</option>';
                                $sqllmscls	= $dblms->querylms("SELECT cs.subject_id, cs.subject_name
																FROM ".CLASS_SUBJECTS." cs  
																WHERE cs.subject_status = '1'
																ORDER BY cs.subject_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['subject_id'] == $valuedetail['id_subject']) { 
							  echo '<option value="'.$valuecls['subject_id'].'" selected>'.$valuecls['subject_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['subject_id'].'">'.$valuecls['subject_name'].'</option>';
						  }
					  }
			  echo '
                	</select>
			</div>
			<div class="col-md-4 form-group">
				<label class="control-label">Teacher</label>
				<select data-plugin-selectTwo data-width="100%" name="id_emply['.$sri.']" id="id_emply['.$sri.']" title="Must Be Required" class="form-control populate">
								<option value="">Select</option>';
                                $sqllmsteacher	= $dblms->querylms("SELECT emply_id, emply_name
																		FROM ".EMPLOYEES." 
																		WHERE emply_status = '1' AND id_type = '1'
																		AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
																		ORDER BY emply_name ASC");
					  while($valueteacher = mysqli_fetch_array($sqllmsteacher)) {
						  if($valueteacher['emply_id'] == $valuedetail['id_teacher']) { 
							  echo '<option value="'.$valueteacher['emply_id'].'" selected>'.$valueteacher['emply_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valueteacher['emply_id'].'">'.$valueteacher['emply_name'].'</option>';
						  }
					  }
								   echo'
                             </select>
		</div>
		<div class="col-md-4 form-group">
				<label class="control-label">Room</label>
				<select data-plugin-selectTwo data-width="100%" name="id_room['.$sri.']" id="id_room['.$sri.']" title="Must Be Required" class="form-control populate">
								
								
								<option value="">Select</option>
								';
                                $sqllmsroom	= $dblms->querylms("SELECT r.room_id, r.room_status, r.room_no
																FROM ".CLASS_ROOMS." r
																WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
																AND r.room_status = '1'
																ORDER BY r.room_no ASC");
					  while($valueroom = mysqli_fetch_array($sqllmsroom)) {
						  if($valueroom['room_id'] == $valuedetail['id_room']) { 
							  echo '<option value="'.$valueroom['room_id'].'" selected>'.$valueroom['room_no'].'</option>';
						  } else { 
							  echo '<option value="'.$valueroom['room_id'].'">'.$valueroom['room_no'].'</option>';
						  }
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
			<button type="submit" id="change_timetable" name="change_timetable" class="mr-xs btn btn-primary">Update Timetable</button>
		</div>
	</div>
</footer>
</form>
</section>
</div>
</div>';
}else{
	header("Location: timetable.php", true, 301);
}
?>