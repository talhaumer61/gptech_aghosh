<?php 
echo '
<!-- Add Modal Box -->
<div id="make_guardian" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Guardian</h2>
			</header>
			<div class="panel-body">
			
			<div class="form-group mt-sm">
				<div class="row">
					<div class="col-md-5 ml-lg"></div>
					<div class="col-md-6">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">
								<img src="uploads/default-student.jpg" alt="...">
							</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 130px"></div>
							<div>
								<span class="btn btn-xs btn-default btn-file">
									<span class="fileinput-new">Select image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="emply_photo" accept="image/*">
								</span>
								<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
					</div>
				</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_name" id="guardian_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Relation <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_relation" id="guardian_relation" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_phone" id="guardian_phone" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Email </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_email" id="guardian_email" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Login ID <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_loginid" id="id_loginid" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Address <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "guardian_address" id="guardian_address" required title="Must Be Required" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="guardian_status" name="guardian_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="guardian_status" name="guardian_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_hostel" name="submit_hostel">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';