<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '65', 'updated' => '1')))
{
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  * 
								   		FROM ".POSTAL_DISPATCH."  
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="postaldispatch.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Dispatch</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">To Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="to_title" id="to_title" required title="Must Be Required" value="'.$rowsvalues['to_title'].'" />
				</div>
			</div>
			
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">To Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "to_phone" id="to_phone" required title="Must Be Required" value="'.$rowsvalues['to_phone'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">To Email <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "to_email" id="to_email" required title="Must Be Required" value="'.$rowsvalues['to_email'].'"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Reference No. <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "reference_no" id="reference_no" required title="Must Be Required" value="'.$rowsvalues['reference_no'].'"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Address <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name = "address" id="address" required title="Must Be Required">'.$rowsvalues['address'].'</textarea>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Note <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "note" id="note" required title="Must Be Required" value="'.$rowsvalues['note'].'"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">From Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "from_title" id="from_title" required title="Must Be Required" value="'.$rowsvalues['from_title'].'"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "dated" id="dated" data-plugin-datepicker required title="Mustrequired title="Must Be Required" value="'.$rowsvalues['dated'].'"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Attachment <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="file" class="form-control" name = "attachment" id="attachment" required title="Must Be Required" value="'.$rowsvalues['attachment'].'"/>
					</div>
				</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Active</label>
					</div>

					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2) {echo' checked';}echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_postaldispatch" name="changes_postaldispatch">Update</button>
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