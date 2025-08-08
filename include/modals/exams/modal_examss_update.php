<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  e.exam_id, e.exam_name, e.exam_startdate, e.exam_enddate, e.exam_comment,
											e.id_term, e.id_session, e.exam_status
								   		FROM ".EXAMS." e 
										WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND e.exam_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
$start_date = date("m-d-Y", strtotime($rowsvalues['exam_startdate']));
$end_date = date("m-d-Y", strtotime($rowsvalues['exam_enddate']));
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="examss.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="exam_id" id="exam_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Exam</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Exam Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="exam_name" id="exam_name" required title="Must Be Required" value="'.$rowsvalues['exam_name'].'" />
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Exam Date  <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="input-daterange input-group" data-plugin-datepicker="">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<input type="text" class="form-control valid" name="exam_startdate" id="exam_startdate" value="'.$start_date .'" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
						<span class="input-group-addon">to</span>
						<input type="text" class="form-control" name = "exam_enddate" id="exam_enddate" value="'.$end_date .'"  required="" title="Must Be Required"  aria-required="true">
					</div>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Comment <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="exam_comment" id="exam_comment" required title="Must Be Required" value="'.$rowsvalues['exam_comment'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Term Name<span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_term">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT term_id, term_name 
													FROM ".EXAM_TERMS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY term_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['term_id'] == $rowsvalues['id_term']) { 
							  echo '<option value="'.$valuecls['term_id'].'" selected>'.$valuecls['term_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['term_id'].'">'.$valuecls['term_name'].'</option>';
						  }
					  }
						echo '
						</select>
					</div>			
				</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Session <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
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
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['exam_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['exam_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="exam_status" name="exam_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_exam" name="changes_exam">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------