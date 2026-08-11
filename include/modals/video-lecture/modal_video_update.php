<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '63', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  id, status, title, facebook_code, youtube_code, id_class, id_subject, id_session
								   FROM ".VIDEO_LECTURE." 
								   WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="video-lecture.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="video_id" id="video_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Video Lecture</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_session" name="id_session">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_status = '1'
													ORDER BY session_name DESC");
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
				<label class="col-md-3 control-label">Class <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_class" name="id_class" onchange="get_classsubject(this.value)">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE class_status = '1'
													ORDER BY class_id ASC");
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
			<div id="getclasssubject">
				<div class="form-group  mb-md">
					<label class="col-md-3 control-label">Subject <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_subject">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT subject_id, subject_code, subject_name 
														FROM ".CLASS_SUBJECTS."
														WHERE subject_status = '1' AND id_class = '".$rowsvalues['id_class']."'
														ORDER BY subject_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
									if($valuecls['subject_id'] == $rowsvalues['id_subject']) { 
										echo '<option value="'.$valuecls['subject_id'].'" selected>'.$valuecls['subject_code'].' - '.$valuecls['subject_name'].'</option>';
									} else {
										echo '<option value="'.$valuecls['subject_id'].'">'.$valuecls['subject_code'].' - '.$valuecls['subject_name'].'</option>';
									}	
								}
						echo '
						</select>
					</div>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="title" name="title" value="'.$rowsvalues['title'].'" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Facebook Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="facebook_code" name="facebook_code" value="'.$rowsvalues['facebook_code'].'" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Youtube Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" id="youtube_code" name="youtube_code" value="'.$rowsvalues['youtube_code'].'" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1) {echo ' checked';} echo '>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2) {echo ' checked';} echo '>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="change_video" name="change_video">Update</button>
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