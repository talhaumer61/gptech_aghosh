<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//--------------------------------------------------------
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'updated' => '1'))){
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  s.session_id, s.session_status, s.session_name, s.session_startdate
								   		FROM ".SESSIONS." s  
										WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND s.session_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------

//------------------------------------------------
$start_date = date("m/d/Y", strtotime($rowsvalues['session_startdate']));
//------------------------------------------------

echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="sessions.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="session_id" id="session_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Session</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Session Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="session_name" id="session_name" required title="Must Be Required" value="'.$rowsvalues['session_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Session Start Date <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="session_startdate" id="session_startdate" data-plugin-datepicker required title="Must Be Required" value="'.$start_date.'" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['session_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="session_status" name="session_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="session_status" name="session_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['session_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="session_status" name="session_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="session_status" name="session_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_session" name="changes_session">Update</button>
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