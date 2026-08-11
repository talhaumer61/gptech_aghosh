<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT e.id, e.status, e.subject, e.detail, e.date_from, 
										e.date_to, e.event_to, e.alert_by
								   FROM ".EVENTS." e 
								   WHERE e.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Event</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Subject <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="subject" id="subject" required title="Must Be Required" value="'.$rowsvalues['subject'].'" />
				</div>
			</div>
			
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Date From <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-daterange input-group" data-plugin-datepicker="">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<input type="text" class="form-control valid" name="date_from" id="date_from" value="'.$rowsvalues['date_from'].'" required title="Must Be Required" aria-required="true" aria-invalid="false">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name = "date_to" id="date_to" value="'.$rowsvalues['date_to'].'" required title="Must Be Required"  aria-required="true">
						</div>
					</div>
				</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Event To <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="event_to" id="event_to" value="'.$rowsvalues['event_to'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="detail" id="detail" required title="Must Be Required" >'.$rowsvalues['detail'].'</textarea>
				</div>
			</div>
			
			  <div class="form-group">
					  <label class="col-md-3 control-label">Added By <span class="required">*</span></label>
					  <div class="col-md-9">
						  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="alert_by">
						  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT emply_id, emply_name 
													  FROM ".EMPLOYEES."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  ORDER BY emply_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['emply_id'] == $rowsvalues['alert_by']) { 
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
					<button type="submit" class="btn btn-primary" id="changes_event" name="changes_event">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------