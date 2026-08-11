<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '15', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  d.designation_id, d.designation_status, d.designation_code, d.designation_name
								   		FROM ".DESIGNATIONS." d  
										WHERE d.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND d.designation_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="designation.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="designation_id" id="designation_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Designation</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-4 control-label">Designation Name <span class="required">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="designation_name" id="designation_name" required title="Must Be Required" value="'.$rowsvalues['designation_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-4 control-label">Designation Code</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="designation_code" id="designation_code" value="'.$rowsvalues['designation_code'].'" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-4 control-label">Status <span class="required">*</span></label>
				<div class="col-md-8">';
					if($rowsvalues['designation_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="designation_status" name="designation_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="designation_status" name="designation_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['designation_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="designation_status" name="designation_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="designation_status" name="designation_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_designation" name="changes_designation">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
//---------------------------------------------------------