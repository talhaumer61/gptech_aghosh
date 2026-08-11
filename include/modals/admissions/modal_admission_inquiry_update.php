<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'edit' => '1')))
{
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  id, status, form_no, name, fathername, gender, dob, nic, guardian, cell_no, address, dated, source, note, id_previousclass, school, id_class, is_orphan, is_hostelized, id_session, cnicno, emailaddress
								   		FROM ".ADMISSIONS_INQUIRY." 
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
	<form action="admission_inquiry.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Admission Inquiry</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Form Number <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="form_no" id="form_no" required title="Must Be Required" value="'.$rowsvalues['form_no'].'" readonly/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_session">
						<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_id != '' AND is_deleted != '1'
													ORDER BY session_id DESC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['session_id'].'" '.($rowsvalues['id_session'] == $valuecls['session_id'] ? 'selected' : '').'>'.$valuecls['session_name'].'</option>';
						}
						echo '
					</select>
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" required title="Must Be Required" value="'.$rowsvalues['name'].'"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Father Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="fathername" id="fathername" required title="Must Be Required" value="'.$rowsvalues['fathername'].'"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Gender <span class="required">*</span></label>
				<div class="col-md-9">
					<select id="gender" name="gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
						<option value="">Select</option>
						<option value="Male"'; if($rowsvalues['gender'] == 'Male') { echo ' selected';} echo '>Male</option>
						<option value="Female"';if($rowsvalues['gender'] == 'Female'){echo' selected';} echo'>Female</option>
					</select>
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Whatsapp <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="cell_no" id="cell_no" required title="Must Be Required" value="'.$rowsvalues['cell_no'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Father CNIC <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="cnicno" id="cnicno" required title="Must Be Required" autocomplete="off" value="'.$rowsvalues['cnicno'].'"  />
				</div>
			</div>
			
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Email Address</label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="emailaddress" id="emailaddress" autocomplete="off" value="'.$rowsvalues['emailaddress'].'"  />
				</div>
			</div>
				
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Address <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="address" id="address" required title="Must Be Required" value="'.$rowsvalues['address'].'" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Previous Class </label>
				<div class="col-md-9">
					<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_previousclass">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																FROM ".CLASSES."
																WHERE class_status = '1' ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['class_id'].'"'; if($rowsvalues['id_previousclass'] == $valuecls['class_id']){echo ' selected';} echo '>'.$valuecls['class_name'].'</option>';
						}
					echo '
					</select>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Previous School </label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="school" id="school" value="'.$rowsvalues['school'].'" autocomplete="off"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Inquiry for Class <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																FROM ".CLASSES."
																WHERE class_status = '1' ORDER BY class_id ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['class_id'].'"'; if($rowsvalues['id_class'] == $valuecls['class_id']){echo ' selected';} echo '>'.$valuecls['class_name'].'</option>';
						}
					echo '
					</select>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Is Orphan <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="is_orphan"'; if($rowsvalues['is_orphan']){echo'disabled';} echo'>
						<option value="">Select</option>';
						foreach($statusyesno as $stat){
							echo '<option value="'.$stat['id'].'"'; if($stat['id'] == $rowsvalues['is_orphan']){echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo '
					</select>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Is Hostelized <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="is_hostelized"'; if($rowsvalues['is_hostelized']){echo'disabled';} echo'>
						<option value="">Select</option>';
						foreach($statusyesno as $stat){
							echo '<option value="'.$stat['id'].'"'; if($stat['id'] == $rowsvalues['is_hostelized']){echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo '
					</select>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Source <span class="required">*</span></label>
				<div class="col-md-9">
					<select id="source" name="source" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
						<option value="">Select</option>';
						foreach($inquirysrc as $source){
							echo '<option value="'.$source['id'].'"'; if($rowsvalues['source'] == $source['id']){echo ' selected';} echo '>'.$source['name'].'</option>';
						}
						echo '
					</select>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Note </label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="note" id="note">'.$rowsvalues['note'].'</textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1){echo 'checked';} echo '>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2){echo 'checked';} echo '>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_inquiry" name="changes_inquiry">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>
<script src="assets/javascripts/jquery.maskedinput.min.js"></script>
<script>
	jQuery(function($) {
      $.mask.definitions["~"]="[+-]";
      $("#cnicno").mask("99999-9999999-9");
	  $("#cell_no").mask("9999-9999999");
	
        });
</script>';
}
?>