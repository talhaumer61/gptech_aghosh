<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'edit' => '1'))){
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT donor_id, donor_status, donor_name, donor_cnic, donor_phone, donor_whatsapp, donor_email, donor_address, city, country
									FROM ".DONORS."
									WHERE donor_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="donors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="donor_id" id="donor_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Donor</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="donor_name" id="donor_name" required title="Must Be Required" value="'.$rowsvalues['donor_name'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Cnic <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="donor_cnic" id="donor_cnic" required title="Must Be Required" value="'.$rowsvalues['donor_cnic'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="donor_phone" id="donor_phone" required title="Must Be Required" value="'.$rowsvalues['donor_phone'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Whstapp <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="donor_whatsapp" id="donor_whatsapp" value="'.$rowsvalues['donor_whatsapp'].'" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Email <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="donor_email" id="donor_email" value="'.$rowsvalues['donor_email'].'" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Country</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="country" id="country" value="'.$rowsvalues['country'].'">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">City</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="city" id="city" value="'.$rowsvalues['city'].'">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Address <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="donor_address" id="donor_address" required title="Must Be Required">'.$rowsvalues['donor_address'].'</textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['donor_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="donor_status" name="donor_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="donor_status" name="donor_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['donor_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="donor_status" name="donor_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="donor_status" name="donor_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_donor" name="changes_donor">Update</button>
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