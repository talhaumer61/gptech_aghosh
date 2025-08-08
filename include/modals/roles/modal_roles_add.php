<?php 
echo '
<!-- Add Modal Box -->
<div id="make_hostel" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="roles.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Add Role</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Role Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="role_name" id="role_name" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Role Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select data-plugin-selectTwo data-width="100%" name="role_type" id="role_type" required title="Must Be Required" class="form-control populate">
							<option value="">Select</option>
							<option value="1">Admission</option>
							<option value="2">Acdamic</option>
							<option value="3">Attendace</option>
							<option value="4">Exams</option>
							<option value="5">HR</option>
							<option value="6">Frenchies</option>
							<option value="7">Complaints</option>
							<option value="8">Accounts</option>
							<option value="9">HR</option>
							<option value="10">Frenchies</option>
							<option value="11">Accounts</option>
							<option value="12">Hostel</option>
							<option value="13">Stationary</option>
							<option value="14">Front Office</option>
							<option value="15">Library</option>
							<option value="16">Awards</option>
							<option value="17">Events</option>
							<option value="18">Admins</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="role_status" name="role_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="role_status" name="role_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_roles" name="submit_roles">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';