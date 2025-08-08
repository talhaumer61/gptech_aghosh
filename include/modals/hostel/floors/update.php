<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT floor_status, floor_name, id_hostel   
								   		FROM ".HOSTEL_FLOORS."
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND floor_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="hostelFloors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="floor_id" id="floor_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Hostel Floor</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Hostel Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="floor_name" id="floor_name" required title="Must Be Required" value="'.$rowsvalues['floor_name'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Hostel Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_hostel">
						<option value="">Select</option>';
						//-----------------------------------------------------
						$sqllmsHostels = $dblms->querylms("SELECT hostel_id, hostel_name
														   FROM ".HOSTELS."
														   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
														   AND hostel_status = '1' AND is_deleted != '1'
														   ORDER BY hostel_name ASC");
						while($valueHostel = mysqli_fetch_array($sqllmsHostels)) {
							echo'<option value="'.$valueHostel['hostel_id'].'"'; if($valueHostel['hostel_id'] == $rowsvalues['id_hostel']){echo'selected';} echo'>'.$valueHostel['hostel_name'].'</option>';
						}
						//-----------------------------------------------------
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="floor_status" name="floor_status" value="1"'; if($rowsvalues['floor_status'] == 1) { echo ' checked';} echo'>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="floor_status" name="floor_status" value="2"'; if($rowsvalues['floor_status'] == 2) { echo'checked';} echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_floor" name="changes_floor">Update</button>
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