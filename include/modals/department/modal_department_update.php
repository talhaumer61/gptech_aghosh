<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '10', 'edit' => '1'))){
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  dep.dept_id, dep.dept_status, dep.dept_code, dep.dept_name
								   		FROM ".DEPARTMENTS." dep  
										WHERE dep.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND dep.dept_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="department.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="dept_id" id="dept_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Department</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-4 control-label">Department Name <span class="required">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="dept_name" id="dept_name" required title="Must Be Required" value="'.$rowsvalues['dept_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-4 control-label">Department Code <span class="required">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="dept_code" id="dept_code" required title="Must Be Required" value="'.$rowsvalues['dept_code'].'" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Status <span class="required">*</span></label>
				<div class="col-md-8">';
					if($rowsvalues['dept_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="dept_status" name="dept_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="dept_status" name="dept_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['dept_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="dept_status" name="dept_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="dept_status" name="dept_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_department" name="changes_department">Update</button>
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