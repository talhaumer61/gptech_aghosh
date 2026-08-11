<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'updated' => '1'))){

//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT g.group_id, g.group_status, g.group_code, g.group_name, g.id_campus

								   FROM ".GROUPS." g
								   WHERE g.group_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="group_id" id="group_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Class Group</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Group Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="group_code" id="group_code" required title="Must Be Required" value="'.$rowsvalues['group_code'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Group Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="group_name" id="group_name" value="'.$rowsvalues['group_name'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Group Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['group_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="group_status" name="group_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="group_status" name="group_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['group_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="group_status" name="group_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="group_status" name="group_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="change_group" name="change_group">Update</button>
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