<?php 
echo '
<!-- Add Modal Box -->
<div id="make_transport" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="transport_vehicles.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make vehicles</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Id Route <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_route">
							<option value="">Select</option>';
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
					<label class="col-md-3 control-label"> Vehicle No <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "vehicle_no" id="vehicle_no" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Vehicle Capacity <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "vehicle_capacity" id="vehicle_capacity" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Driver Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "vehicle_driver" id="vehicle_driver">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Driver Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "vehicle_driverphone" id="vehicle_driverphone"  required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Driver License <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "vehicle_driverlicense" id="vehicle_driverlicense">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
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
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_transport" name="submit_transport">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';