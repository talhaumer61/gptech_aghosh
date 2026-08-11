<?php 
echo '
<!-- Add Modal Box -->
<div id="make_vehicle" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="transportvehicle.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Vehicle</h4>
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
				echo '<option value="'.$valuecls['route_id'].'">'.$valuecls['route_name'].'</option>';
		}
	echo '
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Vehicle No <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_no" id="vehicle_no" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Maximum Allowed <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="number" class="form-control" name="vehicle_capacity" id="vehicle_capacity" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Driver Name <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driver" id="vehicle_driver" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Driver Phone <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driverphone" id="vehicle_driverphone" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group mb-md">
	<label class="col-md-4 control-label">Driver License <span class="required">*</span></label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="vehicle_driverlicense" id="vehicle_driverlicense" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
		<label class="col-sm-4 control-label">Status <span class="required">*</span></label>
		<div class="col-md-8">
			<div class="radio-custom radio-inline">
				<input type="radio" id="vehicle_status" name="vehicle_status" value="1" checked>
				<label for="radioExample1">Active</label>
			</div>
			<div class="radio-custom radio-inline">
				<input type="radio" id="vehicle_status" name="vehicle_status" value="2">
				<label for="radioExample2">Inactive</label>
			</div>
		</div>
	</div>

</div>

<footer class="panel-footer">
	<div class="text-right">
		<button type="submit" class="btn btn-primary" id="submit_vehicle" name="submit_vehicle">Save</button>
		<button class="btn btn-default modal-dismiss">Cancel</button>
	</div>
</footer>
</form>
</section>
</div>
</div>
</div>';