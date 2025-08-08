<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT c.campus_id, c.campus_status, c.campus_regno, c.campus_code, c.campus_name, 
								   c.campus_address, c.campus_email, c.campus_phone, c.campus_head, c.campus_fax, c.campus_website, c.campus_logo
								   FROM ".CAMPUS." c 
								   WHERE c.campus_id = '".cleanvars($_GET['campus_id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="campus_id" id="campus_id" value="'.cleanvars($_GET['campus_id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Campus </h2>
		</header>

		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label"> Registration # <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_regno" id="campus_regno" value="'.$rowsvalues['campus_regno'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label"> Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_code" id="campus_code" value="'.$rowsvalues['campus_code'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label"> Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_name" id="campus_name" value="'.$rowsvalues['campus_name'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label"> Address <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea class="form-control" rows="3" name= "campus_address" id="campus_address" required title="Must Be Required">'.$rowsvalues['campus_address'].'</textarea>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Campus Head <span class="required">*</span></label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="campus_head" id="campus_head"  value="'.$rowsvalues['campus_head'].'" required title="Must Be Required"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label"> E-mail <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_email" id="campus_email" value="'.$rowsvalues['campus_email'].'" required title="Must Be Required" />
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label"> phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_phone" id="campus_phone" value="'.$rowsvalues['campus_phone'].'" required title="Must Be Required" />
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label"> Fax</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_fax" id="campus_fax" value="'.$rowsvalues['campus_fax'].'"/>
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label"> Website</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_website" id="campus_website" value="'.$rowsvalues['campus_website'].'"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label"> Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['campus_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="campus_status" name="campus_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="campus_status" name="campus_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['campus_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="campus_status" name="campus_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="campus_status" name="campus_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_campus" name="changes_campus">Update</button>
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