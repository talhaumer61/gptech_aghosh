<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'updated' => '1')))
{
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  f.id, f.id_inquiry, f.datefollowup, f.next_followupdae, f.response,
										f.note
								   		FROM ".ADMISSIONS_INQUIRYFOLLOWUP." f 
										WHERE f.id = '".cleanvars($_GET['id'])."'LIMIT 1 ");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="admission_inquiryfollowup.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Inquiry Followup</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Id Inquiry<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="id_inquiry" id="id_inquiry" required title="Must Be Required" value="'.$rowsvalues['id_inquiry'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Date Followup <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="datefollowup" id="datefollowup" data-plugin-datepicker required title="Must Be Required" value="'.$rowsvalues['datefollowup'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Next Followupdate <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="next_followupdae" id="next_followupdae" data-plugin-datepicker required title="Must Be Required" value="'.$rowsvalues['next_followupdae'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Response <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="response" id="response" required title="Must Be Required" value="'.$rowsvalues['response'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Note <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="note" id="note" required title="Must Be Required" value="'.$rowsvalues['note'].'" />
				</div>
			</div>

		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_inquiryfollowup" name="changes_inquiryfollowup">Update</button>
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