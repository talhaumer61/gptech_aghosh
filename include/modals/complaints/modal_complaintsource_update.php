<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'added' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  s.source_id, s.source_status, s.source_name, s.source_detail
								   		FROM ".COMPLAINT_SOURCE." s  
										WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND s.source_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="complaintsource.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="source_id" id="source_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Source</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Source Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="source_name" id="source_name" required title="Must Be Required" value="'.$rowsvalues['source_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Source Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="source_detail" id="source_detail" required title="Must Be Required">'.$rowsvalues['source_detail'].'</textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['source_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="source_status" name="source_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="source_status" name="source_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['source_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="source_status" name="source_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="source_status" name="source_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_class" name="changes_source">Update</button>
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