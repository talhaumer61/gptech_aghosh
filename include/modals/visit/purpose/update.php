<?php 
//---------------------------------------------------------
   include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '44', 'edit' => '1'))){
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT p.purpose_id, p.purpose_status, p.purpose_name, p.purpose_detail
								   		FROM ".VISITOR_PURPOSES." p  
										WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND p.purpose_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="visitor_purposes.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="purpose_id" id="purpose_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Visit Purpose</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Purpose Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="purpose_name" id="purpose_name" required title="Must Be Required" value="'.$rowsvalues['purpose_name'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Purpose Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="purpose_detail" id="purpose_detail" required title="Must Be Required" value="'.$rowsvalues['purpose_detail'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['purpose_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="purpose_status" name="purpose_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="purpose_status" name="purpose_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['purpose_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="purpose_status" name="purpose_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="purpose_status" name="purpose_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_purose" name="changes_purpose">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}