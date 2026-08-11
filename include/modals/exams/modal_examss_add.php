<?php 
echo '
<!-- Add Modal Box -->
<div id="make_exams" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="examss.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Add Exam</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Exam Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="exam_name" id="exam_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Exams Date From <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-daterange input-group" data-plugin-datepicker="">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<input type="text" class="form-control valid" name="exam_startdate" id="exam_startdate" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name = "exam_enddate" id="exam_enddate" required="" title="Must Be Required"  aria-required="true">
						</div>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Comment</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name = "exam_comment" id="exam_comment">
					</div>
				</div>				

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Term Name</label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_term">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT term_id, term_name 
													FROM ".EXAM_TERMS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY term_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['term_id'].'">'.$valuecls['term_name'].'</option>';
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
							echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="exam_status" name="exam_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="exam_status" name="exam_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_exam" name="submit_exam">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';