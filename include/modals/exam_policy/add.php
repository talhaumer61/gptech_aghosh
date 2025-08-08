<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_policy" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="exam_policy.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Assessment Policy</h2>
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
								echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_exam" name="id_exam">
						<option value="">Select</option>';
							$sqllmstype	= $dblms->querylms("SELECT type_id, type_name 
													FROM ".EXAM_TYPES."
													WHERE type_status = '1' AND is_deleted != '1'
													ORDER BY type_name ASC");
							while($value_type = mysqli_fetch_array($sqllmstype)) {
								echo '<option value="'.$value_type['type_id'].'">'.$value_type['type_name'].'</option>';
							}
					echo '
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="file" class="form-control" name="file" id="file" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note</label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="note" id="note"></textarea>
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
						<button type="submit" class="btn btn-primary" id="submit_policy" name="submit_policy">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>