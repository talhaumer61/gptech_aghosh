<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  r.role_id, r.role_status, r.role_name, r.role_type
								   		FROM ".ROLES." r  
										WHERE r.role_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="roles.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="role_id" id="role_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Roles</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Role Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="role_name" id="role_name" required title="Must Be Required" value="'.$rowsvalues['role_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Role Type <span class="required">*</span></label>
				<div class="col-md-9">
						<select data-plugin-selectTwo data-width="100%" class="form-control" name = "role_type" id="role_type" required title="Must Be Required">
							<option value='.$rowsvalues['role_type'].'>'.get_roletypes($rowsvalues['role_type']).'</option>
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
						</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['role_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="role_status" name="role_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="role_status" name="role_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['role_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="role_status" name="role_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="role_status" name="role_status" value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					}
			echo '
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_roles" name="changes_roles">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------