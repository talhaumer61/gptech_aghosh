<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1))
{
echo'
<!-- Add Modal Box -->
<div id="make_setting" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="settings.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make New Seetings</h2>
			</header>	
			<div class="panel-body">
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label">Admission Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="adm_session">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_id != '' AND session_status = '1'
													ORDER BY session_id ASC");
								while($value_session = mysqli_fetch_array($sqllms)) {
							echo '<option value="'.$value_session['session_id'].'">'.$value_session['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label">Academic Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="acd_session">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_id != '' AND session_status = '1'
													ORDER BY session_id ASC");
								while($value_session = mysqli_fetch_array($sqllms)) {
							echo '<option value="'.$value_session['session_id'].'">'.$value_session['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mb-md">
					<div class="col-md-12">
						<label class="control-label">Exam Session <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="exam_session">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE session_id != '' AND session_status = '1'
													ORDER BY session_id ASC");
								while($value_session = mysqli_fetch_array($sqllms)) {
							echo '<option value="'.$value_session['session_id'].'">'.$value_session['session_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_settings" name="submit_settings">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>