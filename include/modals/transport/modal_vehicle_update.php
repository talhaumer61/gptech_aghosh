<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT v.vehicle_id, v.vehicle_status, v.vehicle_capacity, v.vehicle_no, v.vehicle_driver, 
								   		v.id_route, v.vehicle_driverphone, v.vehicle_driverlicense 
								  		FROM ".VEHICLES." v 
										WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND v.vehicle_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="transportvehicle.php" class="form-horizontal" id="form" method="post" accept-charset="utf-8">
<input type="hidden" name="vehicle_id" id="vehicle_id" value="'.cleanvars($_GET['id']).'">

<div class="panel-heading">
	<h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Vehicle</h4>
</div>

<div class="panel-body">

<div class="form-group mt-sm">
	<label class="col-md-4 control-label">Route Name <span class="required">*</span></label>
	<div class="col-md-8">
		<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_route">
			<option value="">Select Route</option>';
	$sqllmscls	= $dblms->querylms("SELECT route_id, route_name 
											FROM ".ROUTES."
											WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
											ORDER BY route_name ASC");
	while($valuecls = mysqli_fetch_array($sqllmscls)) {
		if($valuecls['route_id'] == $rowsvalues['id_route']) { 
			echo '<option value="'.$valuecls['route_id'].'" selected>'.$valuecls['route_name'].'</option>';
		} else { 
			echo '<option value="'.$valuecls['route_id'].'">'.$valuecls['route_name'].'</option>';
		}
	}
	echo '
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Vehicle No <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_no" value="'.$rowsvalues['vehicle_no'].'" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Maximum Allowed <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="number" class="form-control" name="vehicle_capacity" value="'.$rowsvalues['vehicle_capacity'].'" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Driver Name <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driver" value="'.$rowsvalues['vehicle_driver'].'" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Driver Phone <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driverphone" value="'.$rowsvalues['vehicle_driverphone'].'" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group mb-md">
	<label class="col-md-4 control-label">Driver License <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driverlicense" value="'.$rowsvalues['vehicle_driverlicense'].'" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4 control-label">Status <span class="required">*</span></label>
	<div class="col-md-8">';
if($rowsvalues['vehicle_status'] == 1) { 
	echo '
		<div class="radio-custom radio-inline">
			<input type="radio" id="vehicle_status" name="vehicle_status" value="1" checked>
			<label for="radioExample1">Active</label>
		</div>';
} else { 
	echo '
		<div class="radio-custom radio-inline">
			<input type="radio" id="vehicle_status" name="vehicle_status" value="1">
			<label for="radioExample1">Active</label>
		</div>';
}
if($rowsvalues['vehicle_status'] == 2) { 
	echo '
		<div class="radio-custom radio-inline">
			<input type="radio" id="vehicle_status" name="vehicle_status" checked value="2">
			<label for="radioExample2">Inactive</label>
		</div>';
} else { 
	echo '
		<div class="radio-custom radio-inline">
			<input type="radio" id="vehicle_status" name="vehicle_status" value="2">
			<label for="radioExample2">Inactive</label>
		</div>';
}
echo '		
	</div>
</div>


</div>
<footer class="panel-footer">
	<div class="text-right">
		<button type="submit" class="btn btn-primary" id="changes_vehicle" name="changes_vehicle">Update</button>
		<button class="btn btn-default modal-dismiss">Cancel</button>
	</div>
</footer>
</form>
</section>
</div>
</div>';