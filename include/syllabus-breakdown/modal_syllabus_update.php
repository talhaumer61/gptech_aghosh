<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '38', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  s.syllabus_id, s.syllabus_status, s.id_session, s.id_month,
								   s.dated, s.syllabus_file, s.id_class, s.id_subject, s.note,
								   se.session_id, se.session_status, se.session_name,
								   c.class_id, c.class_status, c.class_name,
								   cs.subject_id, cs.subject_status, cs.subject_name
								   FROM ".SYLLABUS." s  
								   
								   INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session
								   INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								   INNER JOIN ".CLASS_SUBJECTS." cs ON cs.subject_id = s.id_subject
								   
								   WHERE s.syllabus_id = '".cleanvars($_GET['id'])."'  LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="syllabus_breakdown.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="syllabus_id" id="syllabus_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Syllabus</h2>
		</header>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT session_id, session_status, session_name 
													FROM ".SESSIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND session_status = '1'
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
					<label class="col-md-3 control-label">Month <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_month">
							<option value="">Select</option>';
						foreach($monthtypes as $month) {  
						if($month['id'] == $rowsvalues['id_month']) { 
							echo '<option value="'.$month['id'].'" selected>'.$month['name'].'</option>';
						} else {
							echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
						}
					}
					
				echo '
						</select>
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
				<label class="col-md-3 control-label">Subject <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_subject">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT subject_id, subject_status, subject_name 
													FROM ".CLASS_SUBJECTS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND subject_status = '1'
													ORDER BY subject_name ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								if($valuecls['subject_id'] == $rowsvalues['id_subject']) { 
									echo '<option value="'.$valuecls['subject_id'].'" selected>'.$valuecls['subject_name'].'</option>';
								} else {
									echo '<option value="'.$valuecls['subject_id'].'">'.$valuecls['subject_name'].'</option>';
								}	
							}
					echo '
					</select>
				</div>
			</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="dated" id="dated" value="'.$rowsvalues['dated'].'" required title="Must Be Required"  data-plugin-datepicker/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">File <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="file" class="form-control" name="syllabus_file" id="syllabus_file" value="'.$rowsvalues['syllabus_file'].'" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Note</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
					</div>
				</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['syllabus_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="syllabus_status" name="syllabus_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="syllabus_status" name="syllabus_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['syllabus_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="syllabus_status" name="syllabus_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="syllabus_status" name="syllabus_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_syllabus" name="changes_syllabus">Update</button>
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