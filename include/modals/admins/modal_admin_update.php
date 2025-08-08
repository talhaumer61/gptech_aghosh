<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT a.adm_id, a.adm_status, a.adm_type, a.adm_username, a.adm_fullname, a.adm_email, a.adm_phone, 
									   a.adm_photo, a.id_campus
								   FROM ".ADMINS." a
								   WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND a.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="adm_id" id="adm_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Admin</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Admin type <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_type" id="adm_type" required title="Must Be Required" value="'.$rowsvalues['adm_type'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Admin Username <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_username" id="adm_username" value="'.$rowsvalues['adm_username'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Admin Pass <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_userpass" id="adm_userpass" value="'.$rowsvalues['adm_userpass'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Date To <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="date_to" id="date_to" value="'.$rowsvalues['date_to'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Event To <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_fullname" id="adm_fullname" value="'.$rowsvalues['adm_fullname'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Admin Email<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_email" id="adm_email" value="'.$rowsvalues['adm_email'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Admin Phone<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_phone" id="adm_phone" value="'.$rowsvalues['adm_phone'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Admin Photo<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="adm_photo" id="adm_photo" value="'.$rowsvalues['adm_photo'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['adm_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['adm_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_schoolevent" name="changes_admin">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------