<?php 
echo '
<!-- Add Modal Box -->
<div id="make_route" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="transport_routes.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Route </h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Route Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="route_name" id="route_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Startplace  <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "route_startplace" id="route_startplace">
					</div>
				</div>
					<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Endplace <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="route_endplace" id="route_endplace" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Fare  <span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "route_fare" id="route_fare">
					</div>
				</div>
					<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="route_detail" id="route_detail" required title="Must Be Required"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="route_status" name="route_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="route_status" name="route_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_route" name="submit_route">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';