<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '77', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  id, status, amount, date, id_cat, id_class, id_std, id_session, note
								   FROM ".SCHOLARSHIP."
								   WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowvalues = mysqli_fetch_array($sqllms);
//--------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="fine.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fine</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Category <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
						<option value="">Select</option>';
							$sqllms	= $dblms->querylms("SELECT cat_id, cat_status, cat_type, cat_name 
												FROM ".SCHOLARSHIP_CAT."
												WHERE cat_id != '' AND cat_status = '1' AND cat_type = '3' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
												ORDER BY cat_name ASC");
							while($values = mysqli_fetch_array($sqllms)) {
								 if($values['cat_id'] == $rowvalues['id_cat']) { 
							 		 echo '<option value="'.$values['cat_id'].'" selected>'.$values['cat_name'].'</option>';
						 		 } else { 
							  		echo '<option value="'.$values['cat_id'].'">'.$values['cat_name'].'</option>';
						 		 }
					  			}
						echo '
					</select>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Class <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classstudent(this.value)">
						<option value="">Select</option>';
						$sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
																FROM ".CLASSES." 
																WHERE class_status = '1' ORDER BY class_id ASC");
						while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
							if($value_class['class_id'] == $rowvalues['id_class']){
								echo '<option value="'.$value_class['class_id'].'" selected>'.$value_class['class_name'].'</option>';
							}
							else{
								echo '<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
							}
						}
						echo '
					</select>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Student <span class="required">*</span></label>
				<div class="col-md-9">
					<div id="getclassstudent">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT std_id, std_status, std_name, std_fathername, id_campus
													FROM ".STUDENTS."
													WHERE std_id != '' AND std_status = '1' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													ORDER BY std_name ASC");
								while($values = mysqli_fetch_array($sqllms)) {
									if($values['std_id'] == $rowvalues['id_std']) { 
										echo '<option value="'.$values['std_id'].'" selected>'.$values['std_name'].' '.$values['std_fathername'].'</option>';
									} else { 
										echo '<option value="'.$values['std_id'].'">'.$values['std_name'].' '.$values['std_fathername'].'</option>';
									}
									}
							echo '
						</select>
					</div>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" name="amount" id="amount" value="'.$rowvalues['amount'].'" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Date <span class="required">*</span></label>
				<div class="col-md-9">				
					<input type="month" class="form-control" name="date" id="date" required title="Must Be Required" value="'.date('Y-m' , strtotime($rowvalues['date'])).'">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note </label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="note" id="note">'.$rowvalues['note'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowvalues['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Active</label>
					</div>

					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowvalues['status'] == 2) {echo' checked';}echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_fine" name="changes_fine">Update</button>
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