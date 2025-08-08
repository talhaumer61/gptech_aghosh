<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'edit' => '1'))){ 
	//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  m.id, m.status, m.subject, m.message, m.dated, m.recipient, m.id_session,
										s.session_id, s.session_name
								   		FROM ".MESSAGES." m  
								   
								   		INNER JOIN ".SESSIONS." s ON s.session_id = m.id_session
								   
								   		WHERE m.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND m.id = '".cleanvars($_GET['id'])."' LIMIT 1");
										
	$rowsvalues = mysqli_fetch_array($sqllms);
	//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="message.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="hostel_id" id="hostel_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Message</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Subject <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="subject" id="subject" required title="Must Be Required" value="'.$rowsvalues['subject'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_session">
							<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY session_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['session_id'] == $rowsvalues['id_session']) { 
								echo '<option value="'.$valuecls['session_id'].'" selected>'.$valuecls['session_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
						}
				echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated" value="'.$rowsvalues['dated'].'" data-plugin-datepicker required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Recipient <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="recipient" id="recipient" value="'.$rowsvalues['recipient'].'" required title="Must Be Required" />
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Message</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name = "message" id="message">'.$rowsvalues['message'].'</textarea>
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
					<button type="submit" class="btn btn-primary" id="changes_message" name="changes_message">Update</button>
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