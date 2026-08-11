	<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT b.id, b.status, b.id_std, b.id_role, b.report, b.dated,
								   s.std_id, s.std_status, s.std_firstname, s.std_lastname,
								   r.role_id, r.role_status, r.role_name
								   FROM ".BEHAVIOURS." b
								   
								   INNER JOIN ".STUDENTS." s ON s.std_id = b.id_std
								   INNER JOIN ".BEHAVIOUR_ROLES." r ON r.role_id = b.id_role
								   WHERE b.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND 	 s.std_status = '1'
								   AND 	 r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND   r.role_status= '1'
								   AND b.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="student_behaviour.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Behaviour </h2>
		</header>
		<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT std_id, std_firstname, std_lastname
													FROM ".STUDENTS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND std_status = '1'  
													ORDER BY std_firstname ASC");
								 while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['std_id'] == $rowsvalues['id_std']) { 
							  echo '<option value="'.$valuecls['std_id'].'" selected>'.$valuecls['std_firstname'].' '.$valuecls['std_lastname'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['std_id'].'">'.$valuecls['std_firstname'].' '.$valuecls['std_lastname'].'</option>';
						  }
					  }
			  echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Role <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_role">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT role_id, role_status, role_name
													FROM ".BEHAVIOUR_ROLES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND role_status = '1' 
													ORDER BY role_name ASC");
								 while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['role_id'] == $rowsvalues['id_role']) { 
							  echo '<option value="'.$valuecls['role_id'].'" selected>'.$valuecls['role_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['role_id'].'">'.$valuecls['role_name'].'</option>';
						  }
					  }
			  echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="dated" id="dated" value="'.$rowsvalues['dated'].'" data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Report</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name="report" id="report">'.$rowsvalues['report'].'</textarea>
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
					<button type="submit" class="btn btn-primary" id="changes_behaviour" name="changes_behaviour">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------