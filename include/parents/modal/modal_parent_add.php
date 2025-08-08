<?php 
echo '
<div id="make_parent" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="panel-heading">
			<h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Parent</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7">
					<label class="control-label">Photo</label>
						<div class="form-group">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="uploads/200x200_defualt.png" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
							<div>
								<span class="btn btn-xs btn-default btn-file">
									<span class="fileinput-new">Select image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="userfile" accept="image/*">
								</span>
								<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Guardian Name <span class="required">*</span></label>
						<input type="text" class="form-control" name="guardian_name" required title="Must Be Required" />
					</div>
				</div>
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Relation</label>
						<input type="text" class="form-control" name="relation" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Father Name</label>
						<input type="text" class="form-control" name="father_name" />
					</div>
				</div>
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Father Occupation</label>
						<input type="text" class="form-control" name="father_occupation" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Mother Name</label>
						<input type="text" class="form-control" name="mother_name" />
					</div>
				</div>
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Mother Occupation</label>
						<input type="text" class="form-control" name="mother_occupation" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Email <span class="required">*</span></label>
						<input type="text" class="form-control" name="email" id="email" required title="Must Be Required"/>
					</div>
				</div>
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Password <span class="required">*</span></label>
						<input type="password" class="form-control" name="password" required title="Must Be Required"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-xs">
					<div class="form-group">
						<label class="control-label">Phone <span class="required">*</span></label>
						<input type="text" class="form-control" name="phone" required title="Must Be Required" />
					</div>
				</div>
				<div class="col-md-6 mb-md">
					<div class="form-group">
						<label class="control-label">Address</label>
						<input type="text" class="form-control" name="address" />
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary">Save</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>';