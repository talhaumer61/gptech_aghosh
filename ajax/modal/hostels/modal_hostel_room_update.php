
<script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/user_config/forms_validation.js"></script><script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
		<form action="http://pvssystem.com/rudras_school_demo/hostels/room/update/1" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Hostel Room</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Room Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="name" value="Sample Room" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Hostel Name <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="hostel_name_id">
						<option value="">Select</option>
												<option value="1" selected>Sample Hostel</option>
												<option value="2" >Victory</option>
												</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">No Of Beds <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" required value="10" title="Must Be Required" name="no_of_beds" id="no_of_beds"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Bed Fee <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" required value="100" title="Must Be Required" name="bed_fee" id="bed_fee"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "description"></textarea>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
			</form>
		</section>
    </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$("form#frm").validate({
			rules: {
				no_of_beds: {
					number: true
				},
				bed_fee: {
					number: true
				}
			},

			messages: {
				no_of_beds: {
					number: 'Please enter a valid number.'
				},

				bed_fee: {
					number: 'Please enter a valid number.'
				}
			},

			errorPlacement: function (error, element) {
				var placement = element.closest('.input-group');
				if (!placement.get(0)) {
					placement = element;
				}
				if (error.text() !== '') {
					if (element.parent('.checkbox, .radio').length || element.parent('.input-group').length) {
						placement.after(error);
					} else {
						var placement = element.closest('div');
						placement.append(error);
						wrapper: "li"
					}
				}
			}
		});
	});
</script>