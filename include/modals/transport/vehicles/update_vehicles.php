<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT   v.vehicle_id, v.vehicle_status, v.id_route, v.vehicle_no, v.vehicle_capacity, v.vehicle_driver, v.vehicle_driverphone, v.vehicle_driverlicense 
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
	<form action="transport_vehicles.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="vehicle_id" id="vehicle_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit transport</h2>
		</header>
			<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Route Name<span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_route">
							<option value="">Select</option>';
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
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Vehicle No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="vehicle_no" id="vehicle_no" required title="Must Be Required" value="'.$rowsvalues['vehicle_no'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Vehicle Capacity <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="vehicle_capacity" id="vehicle_capacity" required title="Must Be Required" value="'.$rowsvalues['vehicle_capacity'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Driver  Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="vehicle_driver" id="vehicle_driver" required title="Must Be Required" value="'.$rowsvalues['vehicle_driver'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Driver Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="vehicle_driverphone" id="vehicle_driverphone" required title="Must Be Required" value="'.$rowsvalues['vehicle_driverphone'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Driver License <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="vehicle_driverlicense" id="vehicle_driverlicense" required title="Must Be Required" value="'.$rowsvalues['vehicle_driverlicense'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
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
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_transport" name="changes_transport">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------