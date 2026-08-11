<?php 
echo '
<!-- Add Modal Box -->
<div id="make_route" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="transportroute.php" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i>Make Route</h4>
</div>

<div class="panel-body">

	<div class="form-group mt-sm">
		<label class="col-md-3 control-label">Route Name <span class="required">*</span></label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="route_name" id="route_name" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label">Route Start Place <span class="required">*</span></label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="route_startplace" id="route_startplace" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label">Route Stop Place <span class="required">*</span></label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="route_endplace" id="route_endplace" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label">Route Fare <span class="required">*</span></label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="route_fare" id="route_fare" required title="Must Be Required"/>
		</div>
	</div>
	
	<div class="form-group mb-md">
		<label class="col-md-3 control-label">Description</label>
		<div class="col-md-9">
			<textarea class="form-control" rows="2" name="route_detail" id="route_detail"></textarea>
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
	<div class="text-right">
		<button type="submit" class="btn btn-primary" id="submit_route" name="submit_route">Save</button>
		<button class="btn btn-default modal-dismiss">Cancel</button>
	</div>
</footer>
</form>
</section>
</div>
</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$("form#frm").validate({
			rules: {
				route_fare: {
					number: true
				}
				
			},

			messages: {
				route_fare: {
					number: \'Please enter a valid number.\'
				}
			},

			errorPlacement: function (error, element) {
				var placement = element.closest(\'.input-group\');
				if (!placement.get(0)) {
					placement = element;
				}
				if (error.text() !== \'\') {
					if (element.parent(\'.checkbox, .radio\').length || element.parent(\'.input-group\').length) {
						placement.after(error);
					} else {
						var placement = element.closest(\'div\');
						placement.append(error);
						wrapper: "li"
					}
				}
			}
		});
	});
</script>';