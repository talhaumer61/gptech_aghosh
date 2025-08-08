<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'edit' => '1'))){ 
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  id, status, id_type, id_complaint_type,  complaint_by, id_complaint_by, name, phone, id_source, dated, title, detail, remarks
									FROM ".COMPLAINTS."  
									WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
if($rowsvalues['id_type'] == 1){
	$type = "Complaint";
}else if($rowsvalues['id_type'] == 2){
	$type = "Suggestion";
}
//-----------------------------------------------------
if($rowsvalues['id_source'] == 1){
	$source = "Website";
}else if($rowsvalues['id_source'] == 2){
	$source = "Mobile App";
}
//-----------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="complaint_suggestion.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Complaint & Suggestion  </h2>
		</header>
		<div class="panel-body">

			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Type <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="id_type" id="id_type" readonly value="'.$type.'"/>
				</div>
			</div>

			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="title" id="title" readonly value="'.$rowsvalues['title'].'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Date <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated" data-plugin-datepicker readonly value="'.date("m/d/Y", strtotime($rowsvalues['dated'])).'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Source <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="id_source" id="id_source" readonly value="'.$source.'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">By <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" readonly value="'.get_logintypes($rowsvalues['complaint_by']).'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" readonly value="'.$rowsvalues['name'].'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="phone" id="phone" readonly value="'.$rowsvalues['phone'].'"/>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="remarks" id="remarks" readonly>'.$rowsvalues['detail'].'</textarea>
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Category <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" readonly data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_complaint_type" required>
						<option value="">Select</option>';
							$sqllms_cat	= $dblms->querylms("SELECT type_id, type_name 
												FROM ".COMPLAINT_TYPE." ORDER BY type_name ASC");
							while($value_cat = mysqli_fetch_array($sqllms_cat)) {
								if($value_cat['type_id'] == $rowsvalues['id_complaint_type']) { 
								echo '<option value="'.$value_cat['type_id'].'" selected>'.$value_cat['type_name'].'</option>';
								} else { 
								echo '<option value="'.$value_cat['type_id'].'">'.$value_cat['type_name'].'</option>';
								}
							}
						echo '
					</select>
				</div>
			</div>
			
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Remarks </label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="remarks" id="remarks">'.$rowsvalues['remarks'].'</textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1) { echo'checked';} echo'>
						<label for="radioExample1">Resolved</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2) { echo'checked';} echo'>
						<label for="radioExample1">Pending</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="3"'; if($rowsvalues['status'] == 3) { echo'checked';} echo'>
						<label for="radioExample1">Rejected</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_complaint" name="changes_complaint">Update</button>
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