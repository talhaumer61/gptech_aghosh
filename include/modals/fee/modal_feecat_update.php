<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  c.cat_id, c.cat_status, c.cat_ordering, c.cat_name, c.cat_duration, c.cat_type, c.cat_detail  
								   		FROM ".FEE_CATEGORY." c  
										WHERE c.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND c.cat_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="fee-category.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="cat_id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fee Category</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Catgory Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="cat_name" id="cat_name" required title="Must Be Required" value="'.$rowsvalues['cat_name'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Ordering <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="cat_ordering" id="cat_ordering" required title="Must Be Required" value="'.$rowsvalues['cat_ordering'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Duration <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" name="cat_duration" id="cat_duration" required title="Must Be Required" data-plugin-selectTwo data-width="100%">
						<option vlaue="">Select</option>
						<option vlaue="Yearly"'; 	if($rowsvalues['cat_duration'] == 'Yearly'){echo' selected';} echo'>Yearly</option>
						<option vlaue="Half"'; 		if($rowsvalues['cat_duration'] == 'Half'){echo' selected';} echo'>Half</option>
						<option vlaue="Quatar"'; 	if($rowsvalues['cat_duration'] == 'Quatar'){echo' selected';} echo'>Quatar</option>
						<option vlaue="Monthly"'; 	if($rowsvalues['cat_duration'] == 'Monthly'){echo' selected';} echo'>Monthly</option>
						<option vlaue="Once"'; 		if($rowsvalues['cat_duration'] == 'Once'){echo' selected';} echo'>Once</option>
					</select>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" name="cat_type" id="cat_type" required title="Must Be Required" data-plugin-selectTwo data-width="100%" >
						<option vlaue="">Select</option>
						<option vlaue="Refundable"'; 	 if($rowsvalues['cat_type'] == 'Refundable'){echo' selected';} echo'>Refundable</option>
						<option vlaue="Non-Refundable"'; if($rowsvalues['cat_type'] == 'Non-Refundable'){echo' selected';} echo'>Non-Refundable</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Category Detail </label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="cat_detail" id="cat_detail">'.$rowsvalues['cat_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['cat_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="cat_status" name="cat_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="cat_status" name="cat_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['cat_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="cat_status" name="cat_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="cat_status" name="cat_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_feecat" name="changes_feecat">Update</button>
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