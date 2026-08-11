<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT a.id, a.status, a.award_name, a.gift_item, a.cash_price, 
								   a.award_reason, a.id_class, a.id_std, a.given_date, a.given_by, a.id_session
								   FROM ".STUDENT_AWARDS." a 
								   WHERE a.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
$date = date("m-d-Y", strtotime($rowsvalues['given_date']));
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Award </h2>
		</header>

		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Award Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="award_name" id="award_name" required title="Must Be Required" value="'.$rowsvalues['award_name'].'" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Gift Item <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="gift_item" id="gift_item" value="'.$rowsvalues['gift_item'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Cash Price <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="cash_price" id="cash_price" value="'.$rowsvalues['cash_price'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Award Reason <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="award_reason" id="award_reason" value="'.$rowsvalues['award_reason'].'" required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Given Date <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="given_date" id="given_date" value="'.$date.'" data-plugin-datepicker required title="Must Be Required" />
				</div>
			</div>
			
			<div class="form-group">
					  <label class="col-md-3 control-label">Class <span class="required">*</span></label>
					  <div class="col-md-9">
						  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
						  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
													  FROM ".CLASSES."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  AND class_status = '1'
													  ORDER BY class_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['class_id'] == $rowsvalues['id_class']) { 
							  echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
						  }
					  }
			  echo '
						  </select>
					  </div>
			  </div>
			
			<div class="form-group">
					  <label class="col-md-3 control-label">Student <span class="required">*</span></label>
					  <div class="col-md-9">
						  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std">
						  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT std_id, std_firstname, std_lastname 
													  FROM ".STUDENTS."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  ORDER BY std_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['std_id'] == $rowsvalues['id_std']) { 
							  echo '<option value="'.$valuecls['std_id'].'" selected>'.$valuecls['std_firstname'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['std_id'].'">'.$valuecls['std_firstname'].'</option>';
						  }
					  }
			  echo '
						  </select>
					  </div>
			  </div>
			
			 <div class="form-group">
					  <label class="col-md-3 control-label">Employee <span class="required">*</span></label>
					  <div class="col-md-9">
						  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="given_by">
						  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT emply_id, emply_status, emply_name 
													  FROM ".EMPLOYEES."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  AND emply_status = '1'
													  ORDER BY emply_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['emply_id'] == $rowsvalues['given_by']) { 
							  echo '<option value="'.$valuecls['emply_id'].'" selected>'.$valuecls['emply_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['emply_id'].'">'.$valuecls['emply_name'].'</option>';
						  }
					  }
			  echo '
						  </select>
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
					<button type="submit" class="btn btn-primary" id="changes_award" name="changes_award">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>
';
?>