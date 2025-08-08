<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '87', 'added' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_calender" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="academic-calender.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Academic Calender</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Session <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT session_id, session_status, session_name 
													FROM ".SESSIONS."
													WHERE session_status = '1'
													ORDER BY session_name ASC");
					while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
					}
			echo '
				</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Particular <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_status, cat_name 
													FROM ".ACADEMIC_PARTICULARS."
													WHERE cat_status = '1'
													ORDER BY cat_name ASC");
					while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
					}
			echo '
				</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Start Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" data-plugin-datepicker name="date_start" id="start_date" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">End Date </label>
					<div class="col-md-9">
						<input type="text" class="form-control" data-plugin-datepicker name="date_end" id="end_date" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Published <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="published">
							<option value="">Select</option>
							<option value="1">Yes</option>
							<option value="2">No</option>
						</select>
					</div>
				</div>
				<div class="form-group mt-lg mb-md">
					<label class="col-md-3 control-label">Note </label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "remarks" id="remarks"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_calendar" name="submit_calendar">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>