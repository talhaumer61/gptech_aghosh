<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '24', 'added' => '1'))){ 
$sqllms	= $dblms->querylms("SELECT l.id, l.id_emply, l.reason, l.applied_date, l.id_cat, l.id_session,
								   l.from_date, l.to_date, l.approved_by, l.remarks, l.status,
								   c.cat_name,
								   e.emply_name,
								   s.session_name,
								   d.designation_name
								   FROM ".LEAVE." l
								   
								   INNER JOIN ".LEAVE_CATEGORY." c ON c.cat_id = l.id_cat
								   INNER JOIN ".EMPLOYEES." e ON e.emply_id = l.id_emply
								   INNER JOIN ".SESSIONS." s ON s.session_id = l.id_session
								   INNER JOIN ".DESIGNATIONS." d ON d.designation_id = l.approved_by
								   WHERE l.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   ORDER BY l.applied_date ASC");
$srno = 0;
echo '
<!-- Add Modal Box -->
<div id="make_leave" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="leave.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Leave </h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Leave Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_name 
													FROM ".LEAVE_CATEGORY."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY cat_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Leave For <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="reason" id="reason" required title="Must Be Required"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Applied Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="applied_date" id="applied_date" data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">From Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="from_date" id="from_date" data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">To Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="to_date" id="to_date" data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Employee <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_emply">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT emply_id, emply_name 
													FROM ".EMPLOYEES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY emply_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['emply_id'].'">'.$valuecls['emply_name'].'</option>';
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
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Approved By <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="approved_by">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT designation_id, designation_name 
													FROM ".DESIGNATIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY designation_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['designation_id'].'">'.$valuecls['designation_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Remarks <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="remarks" id="remarks" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Approve</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Pending</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Reject</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_leave" name="submit_leave">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>