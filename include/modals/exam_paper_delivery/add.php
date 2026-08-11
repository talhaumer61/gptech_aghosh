<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'add' => '1'))){ 
	echo '
	<!-- Add Modal Box -->
	<div id="make_paperDelivery" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam_paper_delivery.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Exam Question Paper</h2>
				</header>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-md-3 control-label">Session <span class="required">*</span></label>
						<div class="col-md-9">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
								<option value="">Select</option>';
									$sqllmscls	= $dblms->querylms("SELECT session_id, session_status, session_name 
															FROM ".SESSIONS."
															WHERE session_status = '1' AND is_deleted != '1'
															ORDER BY session_name DESC");
									while($valuecls = mysqli_fetch_array($sqllmscls)) {
										echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
									}
								echo'
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Term <span class="required">*</span></label>
						<div class="col-md-9">
							<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_term">
								<option value="">Select</option>';
								foreach($termrtypes as $term){
									echo'<option value="'.$term['id'].'">'.$term['name'].'</option>';
								}
								echo'
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Exam Type <span class="required">*</span></label>
						<div class="col-md-9">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
								<option value="">Select</option>';
									$sqllmstype	= $dblms->querylms("SELECT type_id, type_name 
															FROM ".EXAM_TYPES."
															WHERE type_id != '' AND type_status = '1' AND is_deleted != '1'
															AND type_id NOT IN (2, 3, 5)
															ORDER BY type_name DESC");
									while($value_type = mysqli_fetch_array($sqllmstype)) {
										echo '<option value="'.$value_type['type_id'].'">'.$value_type['type_name'].'</option>';
									}
							echo '
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Campus <span class="required">*</span></label>
						<div class="col-md-9">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_campus">
								<option value="">Select</option>';
									$sqllms_camp	= $dblms->querylms("SELECT campus_id, campus_status, campus_name 
															FROM ".CAMPUS."
															WHERE campus_status = '1' AND is_deleted != '1'
															ORDER BY campus_name DESC");
									while($value_campus = mysqli_fetch_array($sqllms_camp)) {
										echo '<option value="'.$value_campus['campus_id'].'">'.$value_campus['campus_name'].'</option>';
									}
								echo'
							</select>
						</div>
					</div>
					<div class="form-group mb-md">
						<label class="col-md-3 control-label">Comments </label>
						<div class="col-md-9">
							<textarea class="form-control" rows="2" name="comment" id="comment"></textarea>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary" id="submit_paperDelivery" name="submit_paperDelivery">Save</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>';
}
?>