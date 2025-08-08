
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="transport/vehicle/update/5" class="form-horizontal" id="form" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Vehicle				</h4>
			</div>

			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-4 control-label">Route Name <span class="required">*</span></label>
					<div class="col-md-8">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required
						title="Must Be Required" name = "route_id">
							<option value="">Select Route</option>
															<option value="1" >Sample Route</option>
															<option value="2" >aS</option>
															<option value="3" >czxc</option>
															<option value="4" >new</option>
															<option value="5" selected>Kalyan</option>
													</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Vehicle No <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="vehicle_no" value="MH-08-TS-1881" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Maximum Allowed <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="number" class="form-control" name="maximum_allowed" value="42" required
						title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Insurance Renewal Date</label>
					<div class="col-md-8">
						<input type="text" class="form-control" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' name="insurance_renewal"
						value="04/25/2018"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Driver Name <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="driver_name" value="Thahir" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Driver Phone <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="driver_phone" value="987654321" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-4 control-label">Driver License <span class="required">*</span></label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="driver_license" value="HM65/2015" required title="Must Be Required"/>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</footer>
			</form>		</section>
	</div>
</div>
