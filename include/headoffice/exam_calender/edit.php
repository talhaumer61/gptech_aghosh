<?php
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '12', 'edit' => '1'))){   
//---------------------------------------------------------
$sqllmsexam	= $dblms->querylms("SELECT a.id, a.status, a.published, a.id_session, a.term, a.term_start, a.term_end, a.dated,
								s.session_id, s.session_status, s.session_name
								FROM ".EXAM_CALENDER." a 
								INNER JOIN ".SESSIONS." s ON s.session_id = a.id_session
								WHERE a.id = '".$_GET['id']."' LIMIT 1");			   
$value_exam = mysqli_fetch_array($sqllmsexam);
//---------------------------------------------------------
	echo '
	  <section class="panel panel-featured panel-featured-primary">
	  
			  <form action="exam_calender.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
				  <header class="panel-heading">
					  <h2 class="panel-title"><i class="fa fa-plus-square"></i>	Edit Exam Calendar</h2>
				  </header>
				<div class="panel-body">
					<input type="hidden" name="id" id="id" value="'.$value_exam['id'].'">
					  <div class="form-group">
					  	<div class="col-md-6">
							<label class="control-label">Session <span class="required">*</span></label>
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
								<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
															FROM ".SESSIONS."
															WHERE session_id != '' 
															ORDER BY session_id DESC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['session_id'].'"'; if($value_exam['id_session'] == $valuecls['session_id']){ echo 'selected';} echo '>'.$valuecls['session_name'].'</option>';
								}
							echo '
							</select>
						</div>
						<div class="col-md-6">
							<label class="control-label">Publish <span class="required">*</span></label>
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="published">
								<option value="">Select</option>
								<option value="1"'; if($value_exam['published'] == 1){ echo 'selected';} echo '>Yes</option>
								<option value="2"'; if($value_exam['published'] == 2){ echo 'selected';} echo '>No</option>
							</select>
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-md-4">
							<label class="control-label">Term <span class="required">*</span></label>
							<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="term">
								<option value="">Select</option>
								<option value="1"'; if($value_exam['term'] == 1){ echo 'selected';} echo '>First Term</option>
								<option value="2"'; if($value_exam['term'] == 2){ echo 'selected';} echo '>Second Term</option>
							</select>
						</div>
						<div class="col-md-4">
							<label class="control-label">Start <span class="required">*</span></label>
							<input type="text" class="form-control" name="term_start" id="term_start" value="'.date('m/d/Y', strtotime($value_exam['term_start'])).'" autocomplete="off" data-plugin-datepicker/>
						</div>
						<div class="col-md-4">
							<label class="control-label">End <span class="required">*</span></label>
							<input type="text" class="form-control" name="term_end" id="term_end" value="'.date('m/d/Y', strtotime($value_exam['term_end'])).'" autocomplete="off" data-plugin-datepicker/>
						</div>
					  </div>
					  <div class="form-group">
						  <label class="col-sm-1 control-label">Status <span class="required">*</span></label>
						  <div class="col-md-9">
							  <div class="radio-custom radio-inline">
								  <input type="radio" id="status" name="status" value="1"'; if($value_exam['status'] == 1){ echo 'checked';} echo '>
								  <label for="radioExample1">Active</label>
							  </div>
							  <div class="radio-custom radio-inline">
								  <input type="radio" id="status" name="status" value="2"'; if($value_exam['status'] == 2){ echo 'checked';} echo '>
								  <label for="radioExample2">Inactive</label>
							  </div>
						  </div>
					  </div>
					  
					  <br>
					  
					  <table class="table table-hover table-striped table-condensed mb-none">
						  <thead>
							  <tr>
								  <th class="text-center">Category</th>
								  <th class="text-center">Start Date</th>
								  <th class="text-center">End Date</th>
								  <th class="text-center">Remarks</th>
							  </tr>
						  </thead>
						  <tbody>';
  //-----------------------------------------------------
  $sqllms	= $dblms->querylms("SELECT type_id, type_name
									 FROM ".EXAM_TYPES."												 
									 WHERE type_status = '1' 
									 ORDER BY type_name ASC");
  $srno = 0;
  //-----------------------------------------------------
  while($rowsvalues = mysqli_fetch_array($sqllms)) {
  //-----------------------------------------------------
  $srno++;
	//-----------------------------------------------------
	$sqllmsdetail	= $dblms->querylms("SELECT d.id, d.id_type, d.date_start, d.date_end, d.remarks
									FROM ".EXAM_CALENDER_DETAIL." d												 
									WHERE d.id_setup = '".$value_exam['id']."' AND d.id_type = '".$rowsvalues['type_id']."'
									LIMIT 1");
	$value_detail = mysqli_fetch_array($sqllmsdetail);
  //-----------------------------------------------------
  echo '
  <input type="hidden" name="id_type['.$srno.']" id="id_type['.$srno.']" value="'.$rowsvalues['type_id'].'">
  <input type="hidden" name="id_edit['.$srno.']" id="id_edit['.$srno.']" value="'.$value_detail['id'].'">
							  <tr>
								  <td >'.$rowsvalues['type_name'].'</td>
								 <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
										  		<input type="text" class="form-control" name="date_start['.$srno.']" id="date_start['.$srno.']" value="'.$value_detail['date_start'].'" autocomplete="off" data-plugin-datepicker/>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
										  	  <input type="text" class="form-control" name="date_end['.$srno.']" id="date_end['.$srno.']" value="'.$value_detail['date_end'].'" autocomplete="off" data-plugin-datepicker/>
										  </div>
									  </div>
								  </td>
								  <td>
									  <div class="form-group mt-sm">
										  <div class="col-md-12">
										  		<input type="text" class="form-control" name="remarks['.$srno.']" id="remarks['.$srno.']" value="'.$value_detail['remarks'].'" autocomplete="off"/>
										  </div>
									  </div>
								  </td>
							  </tr>';
  //-----------------------------------------------------
  }
  //-----------------------------------------------------
  echo '
					  </tbody>
			  </table>
					  
				  </div>
		  
				  <footer class="panel-footer">
					  <div class="row">
						  <div class="col-md-12 text-right">
							  <button type="submit" class="btn btn-primary" id="changes_calendar" name="changes_calendar">Save</button>
							  <button class="btn btn-default modal-dismiss">Cancel</button>
						  </div>
					  </div>
				  </footer>
		  		</div>
			</form>
	  </section>';
}
else{
	header("Location: academic-calender.php");
}
?>