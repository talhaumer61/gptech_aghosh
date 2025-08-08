
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="transport/maintain/update/1" class="form-horizontal" id="form" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Route				</h4>
			</div>

			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Route Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="route_name" value="Sample Route" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Route Start Place <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="route_start_place" value="Thamrin" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Route Stop Place <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="route_stop_place" value="Pondok Cabe" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Route Fare <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name="route_fare" value="50" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "description">Naik turun gunung</textarea>
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
