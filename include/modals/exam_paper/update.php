<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '83', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  exam_id, exam_status, exam_comment, id_month, id_class, id_subject, id_type, id_term, id_session
								   FROM ".EXAMS."
								   WHERE exam_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam_paper.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<input type="hidden" name="exam_id" id="exam_id" value="'.cleanvars($_GET['id']).'">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Question Paper</h2>
				</header>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-md-3 control-label">Session <span class="required">*</span></label>
							<div class="col-md-9">
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
									<option value="">Select</option>';
										$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
																FROM ".SESSIONS."
																WHERE session_status = '1' AND is_deleted != '1'
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
							<label class="col-md-3 control-label">Term <span class="required">*</span></label>
							<div class="col-md-9">
								<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_term">
									<option value="">Select</option>';
										foreach($termrtypes as $term){
											echo'<option value="'.$term['id'].'"'; if($term['id'] == $rowsvalues['id_term']){ echo'selected';} echo'>'.$term['name'].'</option>';
										}
									echo'
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Exam Type <span class="required">*</span></label>
							<div class="col-md-9">
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type" onchange="get_examtype(this.value)">
									<option value="">Select</option>';
										$sqllmstype	= $dblms->querylms("SELECT type_id, type_name 
																FROM ".EXAM_TYPES."
																WHERE type_id != '' AND type_status = '1' AND is_deleted != '1'
																AND type_id IN (2, 3, 5)
																ORDER BY type_name DESC");
										while($value_type = mysqli_fetch_array($sqllmstype)) {
											echo '<option value="'.$value_type['type_id'].'"'; if($value_type['type_id'] == $rowsvalues['id_type']){echo'selected';} echo'>'.$value_type['type_name'].'</option>';
										}
								echo '
								</select>
							</div>
						</div>';
						if($rowsvalues['id_month']){
							echo'
							<div class="form-group">
								<label class="col-md-3 control-label">Month <span class="required">*</span></label>
								<div class="col-md-9">
									<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_month" name="id_month">
										<option value="">Select</option>';
											foreach($monthtypes as $month) {
												echo '<option value="'.$month['id'].'"'; if($month['id'] == $rowsvalues['id_month']){ echo 'selected';} echo'>'.$month['name'].'</option>';
											}
									echo '
									</select>
								</div>
							</div>';
						}
						else{
							echo'<div id="get_examtype"></div>';
						}
						echo'
						<div class="form-group">
							<label class="col-md-3 control-label">Class <span class="required">*</span></label>
							<div class="col-md-9">
								<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_class" name="id_class" onchange="get_classsubject(this.value)">
									<option value="">Select</option>';
										$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
																FROM ".CLASSES."
																WHERE class_status = '1' AND is_deleted != '1'
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
																	WHERE subject_status = '1' AND is_deleted != '1'
																	AND id_class = '".$rowsvalues['id_class']."'
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
					<div class="form-group">
						<label class="col-md-3 control-label">File </label>
						<div class="col-md-9">
							<input type="file" class="form-control" name="exam_file" id="exam_file" value="'.$rowsvalues['exam_file'].'"/>
						</div>
					</div>
					<div class="form-group mb-md">
						<label class="col-md-3 control-label">Comment</label>
						<div class="col-md-9">
							<textarea class="form-control" rows="2" name="exam_comment" id="exam_comment">'.$rowsvalues['exam_comment'].'</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Publish <span class="required">*</span></label>
						<div class="col-md-9">
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" value="1"'; if($rowsvalues['exam_status'] == 1) {echo'checked';} echo'>
								<label for="radioExample1">Yes</label>
							</div>
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" value="2"'; if($rowsvalues['exam_status'] == 2) {echo'checked';} echo'>
								<label for="radioExample1">No</label>
							</div>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary" id="changes_questionpaper" name="changes_questionpaper">Update</button>
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