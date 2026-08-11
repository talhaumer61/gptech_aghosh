<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  a.adm_id, a.adm_status, a.adm_type, a.adm_username, a.adm_fullname,
								   		a.adm_email, a.adm_phone, a.adm_photo, a.adm_photo, a.id_campus,
										c.campus_id, c.campus_status, c.campus_name

										FROM ".ADMINS." a 
										INNER JOIN  ".CAMPUS." c ON c.campus_id = a.id_campus
										WHERE c.campus_status = '1'
										AND a.adm_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="adm_id" id="adm_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Admin</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_fullname" id="adm_fullname" value="'.$rowsvalues['adm_fullname'].'" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Email </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_email" id="adm_email" value="'.$rowsvalues['adm_email'].'"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Phone </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_phone" id="adm_phone" value="'.$rowsvalues['adm_phone'].'"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">User Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_username" id="adm_username" value="'.$rowsvalues['adm_username'].'" required title="Must Be Required"/>
					</div>
				</div>
			<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select name="adm_type" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required" >
						<option value="">Select Type</option>';
							foreach($admtypes as $itemadmtypes) {
								if($listtype['id'] == $rowsvalues['id_type']) { 
							echo '<option value="'.$itemadmtypes['id'].'" selected>'.$itemadmtypes['name'].'</option>';
						} else {
							echo '<option value="'.$itemadmtypes['id'].'">'.$itemadmtypes['name'].'</option>';
						}
								}
		echo '			</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Campus <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_campus"> 
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT campus_id, campus_status, campus_name 
																										FROM ".CAMPUS." 
																										WHERE campus_status = '1'
																										ORDER BY campus_name ASC");
														while($valuecls = mysqli_fetch_array($sqllmscls)) {
															if($valuecls['campus_id'] == $rowsvalues['id_campus']) { 
																echo '<option value="'.$valuecls['campus_id'].'" selected>'.$valuecls['campus_name'].'</option>';
															} else { 
																echo '<option value="'.$valuecls['campus_id'].'">'.$valuecls['campus_name'].'</option>';
															}
														}
														echo '
						</select>
					</div>
				</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['adm_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="adm_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="adm_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['adm_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="adm_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="adm_status" name="adm_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_hostel" name="changes_hostel">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------