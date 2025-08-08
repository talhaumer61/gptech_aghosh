<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  a.id, a.status, a.published, a.id_session, a.dated,
									d.id, d.id_setup, d.id_cat, d.date_start, d.date_end, d.remarks,
									s.session_id, s.session_status, s.session_name,
									cat_id, cat_status, cat_name
								   FROM ".A_CALENAR." a 
								   INNER JOIN ".ACADEMIC_DETAIL." 		d ON d.id_setup   = a.id
								   INNER JOIN ".SESSIONS."  					s ON s.session_id = a.id_session
								   INNER JOIN ".ACADEMIC_PARTICULARS."  	c ON c.cat_id = d.id_cat
								   WHERE a.id = '".$_GET['id']."'");			   
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="academic-calender.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="text" name="id" id="id" value="'.cleanvars($_GET['id']).'">
	<input type="text" name="detail_id" id="detail_id" value="'.cleanvars($rowsvalues['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Academic Calendar</h2>
		</header>
		<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Session <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
					<option value="">Select</option>';
						$sqllms	= $dblms->querylms("SELECT session_id, session_status, session_name 
													FROM ".SESSIONS."
													WHERE session_status = '1'
													ORDER BY session_name ASC");
					  while($valuesession = mysqli_fetch_array($sqllms)) {
						  if($valuesession['session_id'] == $rowsvalues['id_session']) { 
							  echo '<option value="'.$valuesession['session_id'].'" selected>'.$valuesession['session_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuesession['session_id'].'">'.$valuesession['session_name'].'</option>';
						  }
					  }
			echo '
				</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Particular <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_status, cat_name 
													FROM ".ACADEMICCALENAR_PARTICULARS."
													WHERE cat_status = '1'
													ORDER BY cat_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['cat_id'] == $rowsvalues['id_cat']) { 
							  echo '<option value="'.$valuecls['cat_id'].'" selected>'.$valuecls['cat_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
						  }
					  }
			echo '
				</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Start Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" data-plugin-datepicker name="date_start" id="date_start" value="'.$rowsvalues['date_start'].'" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">End Date </label>
					<div class="col-md-9">
						<input type="text" class="form-control" data-plugin-datepicker name="date_end" id="date_end" value="'.$rowsvalues['date_end'].'" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Published <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="published">
							<option value="'.$rowsvalues['published'].'">'.get_notification($rowsvalues['published']).'</option>
							<option value="1">Yes</option>
							<option value="2">No</option>
						</select>
					</div>
				</div>
				<div class="form-group mt-lg mb-md">
					<label class="col-md-3 control-label">Note </label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name="remarks" id="remarks">'.$rowsvalues['remarks'].'</textarea>
					</div>
				</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Active</label>
					</div>

					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2) {echo' checked';}echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_calendar" name="changes_calendar">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>