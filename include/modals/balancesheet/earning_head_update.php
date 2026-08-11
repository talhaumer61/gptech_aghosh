<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT head_id, head_status, head_name
									FROM ".ACCOUNT_HEADS."
									WHERE head_type = '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND head_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="earninghead.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="head_id" id="head_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Income Head</h2>
		</header>
		<div class="panel-body">

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Head Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="head_name" id="head_name" required title="Must Be Required" value="'.$rowsvalues['head_name'].'" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="head_status" name="head_status" value="1"';if($rowsvalues['head_status'] == 1) { echo ' checked';} echo '>
						<label for="radioExample1">Active</label>
					</div>
			
					<div class="radio-custom radio-inline">
						<input type="radio" id="head_status" name="head_status" value="2"';if($rowsvalues['head_status'] == 2) { echo ' checked';} echo '>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_earning_head" name="changes_earning_head">Update</button>
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