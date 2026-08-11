<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT g.guardian_id, g.guardian_status, g.guardian_name, g.guardian_relation, g.guardian_email,
								   g.guardian_phone, g.guardian_address, g.guardian_photo, g.id_loginid
								   FROM ".GUARDIANS." g 
								   WHERE g.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   g.guardian_status = '1'
								   ORDER BY g.guardian_name ASC");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="guardian_id" id="guardian_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Hostel</h2>
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
						<input type="text" class="form-control" name="guardian_name" id="guardian_name" required title="Must Be Required" value="'.$rowsvalues['guardian_name'].'"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Relation <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_relation" id="guardian_relation" required title="Must Be Required" value="'.$rowsvalues['guardian_relation'].'"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_phone" id="guardian_phone" required title="Must Be Required" value="'.$rowsvalues['guardian_phone'].'"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Email </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="guardian_email" id="guardian_email" value="'.$rowsvalues['guardian_email'].'"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Login ID <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_loginid" id="id_loginid" required title="Must Be Required" value="'.$rowsvalues['id_loginid'].'"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Address <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "guardian_address" id="guardian_address" required title="Must Be Required" >'.$rowsvalues['guardian_address'].'</textarea>
					</div>
				</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['guardian_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="guardian_status" name="guardian_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="guardian_status" name="guardian_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['guardian_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="guardian_status" name="guardian_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="guardian_status" name="guardian_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_guardian" name="changes_guardian">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------