<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT adm_id, adm_status, adm_username, adm_fullname, adm_email, adm_phone, adm_photo 
									FROM ".ADMINS." 
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND adm_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="parentlogin.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="adm_id" id="adm_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Parent Login</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Student Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="adm_fullname" name="adm_fullname" value="'.$rowsvalues['adm_fullname'].'" required title="Must Be Required" readonly/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Phone </label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="adm_phone" name="adm_phone" value="'.$rowsvalues['adm_phone'].'" readonly/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Email </label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="adm_email" name="adm_email" value="'.$rowsvalues['adm_email'].'" readonly/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Username <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="adm_username" name="adm_username" value="'.$rowsvalues['adm_username'].'" required title="Must Be Required" readonly/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Password</label>
				<div class="col-md-9">
					<input type="password" class="form-control" id="adm_userpass" name="adm_userpass"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="adm_status" name="adm_status" value="1"'; if($rowsvalues['adm_status'] == 1) { echo ' checked';} echo '>
						<label for="radioExample1">Active</label>
					</div>
			
					<div class="radio-custom radio-inline">
						<input type="radio" id="adm_status" name="adm_status" value="2"'; if($rowsvalues['adm_status'] == 2) { echo ' checked';} echo '>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_parent" name="changes_parent">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>