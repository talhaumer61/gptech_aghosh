<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '30', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  * 
								   		FROM ".COMPLAINTS."  
										WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND id_type = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="complaints.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id_type" id="id_type" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Complaint </h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Complaint Type <span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT type_id, type_name 
													FROM ".COMPLAINT_TYPE."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY type_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							 if($valuecls['type_id'] == $rowsvalues['id_type']) { 
							  echo '<option value="'.$valuecls['type_id'].'" selected>'.$valuecls['type_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['type_id'].'">'.$valuecls['type_name'].'</option>';
						  }
					  }
						echo '
						</select>
					</div>
			</div>
			<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Complaint By<span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="complaint_by">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT source_id, source_name 
													FROM ".COMPLAINT_SOURCE."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY source_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							 if($valuecls['source_id'] == $rowsvalues['complaint_by']) { 
							  echo '<option value="'.$valuecls['source_id'].'" selected>'.$valuecls['source_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['source_id'].'">'.$valuecls['source_name'].'</option>';
						  }
					  }
						echo '
						</select>
					</div>
			</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Phone<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "phone" id="phone" required title="Must Be Required" value="'.$rowsvalues['phone'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Dated<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "dated" id="dated" data-plugin-datepicker required title="Must Be Required" value="'.$rowsvalues['dated'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Detail<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "detail" id="detail" required title="Must Be Required" value="'.$rowsvalues['detail'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Action Taken<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "action_taken" id="action_taken" required title="Must Be Required" value="'.$rowsvalues['action_taken'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Assigned<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "assigned" id="assigned" required title="Must Be Required" value="'.$rowsvalues['assigned'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Note<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "note" id="note" required title="Must Be Required" value="'.$rowsvalues['note'].'"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Attachment<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "attachment" id="attachment" required title="Must Be Required" value="'.$rowsvalues['attachment'].'"/>
					</div>
				</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="2">
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