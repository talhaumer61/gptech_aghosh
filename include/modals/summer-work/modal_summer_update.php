<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '62', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT summer_id, summer_status, summer_file, id_month, id_class, id_type, note, id_session
								   FROM ".SUMMER_WORK." 
								   WHERE summer_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="summer-work.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="summer_id" id="summer_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Vacational Engagement Task</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_status = '1'
													ORDER BY session_name DESC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								if($valuecls['session_id'] == $rowsvalues['id_session']) { 
									echo '<option value="'.$valuecls['session_id'].'" selected>'.$valuecls['session_name'].'</option>';
								} else {
									echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
								}	
							}
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Month <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_month" name="id_month">
						<option value="">Select</option>';
							foreach($monthtypes as $month) {
								echo '<option value="'.$month['id'].'"'; if($rowsvalues['id_month'] == $month['id']){ echo 'selected';} echo'>'.$month['name'].'</option>';
							}
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Class <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_class" name="id_class">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE class_status = '1'
													ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								if($valuecls['class_id'] == $rowsvalues['id_class']) { 
									echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
								} else {
									echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
								}	
							}
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_type" name="id_type">
						<option value="">Select</option>
						<option value="1"'; if($rowsvalues['id_type'] == '1'){echo'selected';} echo'>Summer</option>
						<option value="2"'; if($rowsvalues['id_type'] == '2'){echo'selected';} echo'>Winter</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File </label>
				<div class="col-md-9">
					<input type="file" class="form-control" name="summer_file" id="summer_file" value="'.$rowsvalues['summer_file'].'"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="summer_status" name="summer_status" value="1"'; if($rowsvalues['summer_status'] == 1) { echo ' checked';} echo '>
						<label for="radioExample1">Active</label>
					</div>
			
					<div class="radio-custom radio-inline">
						<input type="radio" id="summer_status" name="summer_status" value="2"'; if($rowsvalues['summer_status'] == 2) { echo ' checked';} echo '>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_summer_work" name="changes_summer_work">Update</button>
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