<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  h.hostel_id, h.hostel_status, h.hostel_name, h.hostel_warden, h.hostel_phone, h.id_type, h.hostel_address, h.hostel_detail   
								   		FROM ".HOSTELS." h  
										WHERE h.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND h.hostel_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="hostels.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" auto-complete="off">
	<input type="hidden" name="hostel_id" id="hostel_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Hostel</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Hostel Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="hostel_name" id="hostel_name" required title="Must Be Required" value="'.$rowsvalues['hostel_name'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">warden <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="hostel_warden" id="hostel_warden" value="'.$rowsvalues['hostel_warden'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="hostel_phone" id="hostel_phone" value="'.$rowsvalues['hostel_phone'].'"  required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Hostel Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_type">
							<option value="">Select</option>';
					foreach($hostelype as $listtype) { 
						if($listtype['id'] == $rowsvalues['id_type']) { 
							echo '<option value="'.$listtype['id'].'" selected>'.$listtype['name'].'</option>';
						} else {
							echo '<option value="'.$listtype['id'].'">'.$listtype['name'].'</option>';
						}
					}
				echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Hostel Address <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" id="hostel_address" name="hostel_address">'.$rowsvalues['hostel_address'].'</textarea>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Description</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name = "hostel_detail" id="hostel_detail">'.$rowsvalues['hostel_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="hostel_status" name="hostel_status" value="1"'; if($rowsvalues['hostel_status'] == 1) { echo ' checked';} echo'>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="hostel_status" name="hostel_status" value="2"'; if($rowsvalues['hostel_status'] == 2) { echo'checked';} echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_hostel" name="changes_hostel">Update</button>
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