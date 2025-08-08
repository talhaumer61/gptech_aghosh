<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '84', 'edit' => '1'))){ 
//---------------------------------------------------------
echo'
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>';

	//----------------------FOR HEAD OFFICE-----------------------------------
	if($_SESSION['userlogininfo']['LOGINAFOR']  == 1)
	{
		$sqllms	= $dblms->querylms("SELECT  delivery_id, delivery_status, comment, id_type, id_term, id_session
								   FROM ".EXAM_DELIVERY."
								   WHERE delivery_id = '".cleanvars($_GET['id'])."' LIMIT 1");
		$rowsvalues = mysqli_fetch_array($sqllms);
		//---------------------------------------------------------
		echo'
		<div class="row">
			<div class="col-md-12">
				<section class="panel panel-featured panel-featured-primary">
					<form action="exam_paper_delivery.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<input type="hidden" name="delivery_id" id="delivery_id" value="'.cleanvars($_GET['id']).'">
						<header class="panel-heading">
							<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Dispatch Paper</h2>
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
									<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
										<option value="">Select</option>';
											$sqllmstype	= $dblms->querylms("SELECT type_id, type_name 
																	FROM ".EXAM_TYPES."
																	WHERE type_id != '' AND type_status = '1' AND is_deleted != '1'
																	AND type_id NOT IN (2, 3, 5)
																	ORDER BY type_name DESC");
											while($value_type = mysqli_fetch_array($sqllmstype)) {
												echo '<option value="'.$value_type['type_id'].'"'; if($value_type['type_id'] == $rowsvalues['id_type']){echo'selected';} echo'>'.$value_type['type_name'].'</option>';
											}
									echo '
									</select>
								</div>
							</div>
							<div class="form-group mb-md">
								<label class="col-md-3 control-label">Comment</label>
								<div class="col-md-9">
									<textarea class="form-control" rows="2" name="comment" id="comment">'.$rowsvalues['comment'].'</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Publish <span class="required">*</span></label>
								<div class="col-md-9">
									<div class="radio-custom radio-inline">
										<input type="radio" id="delivery_status" name="delivery_status" value="1"'; if($rowsvalues['delivery_status'] == 1) {echo'checked';} echo'>
										<label for="radioExample1">Pending</label>
									</div>
									<div class="radio-custom radio-inline">
										<input type="radio" id="delivery_status" name="delivery_status" value="4"'; if($rowsvalues['delivery_status'] == 4) {echo'checked';} echo'>
										<label for="radioExample1">Dispatched</label>
									</div>
									<div class="radio-custom radio-inline">
										<input type="radio" id="delivery_status" name="delivery_status" value="5"'; if($rowsvalues['delivery_status'] == 5) {echo'checked';} echo'>
										<label for="radioExample1">Delivered</label>
									</div>
								</div>
							</div>
						</div>
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn btn-primary" id="changes_paperDelivery" name="changes_paperDelivery">Update</button>
									<button class="btn btn-default modal-dismiss">Cancel</button>
								</div>
							</div>
						</footer>
					</form>
				</section>
			</div>
		</div>';

	}
	//----------------------FOR CAMPUS-----------------------------------
	else if($_SESSION['userlogininfo']['LOGINAFOR']  == 2)
	{
		$sqllms	= $dblms->querylms("SELECT  d.delivery_id , d.delivery_status, d.receive_status, d.comment, d.id_term,
											t.type_name, c.campus_name, se.session_name
											FROM ".EXAM_DELIVERY." d
											INNER JOIN ".EXAM_TYPES." t ON t.type_id = d.id_type
											INNER JOIN ".CAMPUS." c ON c.campus_id = d.id_campus
											INNER JOIN ".SESSIONS." se ON se.session_id = d.id_session
								   			WHERE delivery_id = '".cleanvars($_GET['id'])."' LIMIT 1");
		$rowsvalues = mysqli_fetch_array($sqllms);
		//---------------------------------------------------------
		echo'
		<div class="row">
			<div class="col-md-12">
				<section class="panel panel-featured panel-featured-primary">
					<form action="exam_paper_delivery.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<input type="hidden" name="delivery_id" id="delivery_id" value="'.cleanvars($_GET['id']).'">
						<header class="panel-heading">
							<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Dispatch Paper</h2>
						</header>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Session <span class="required">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="id_type" id="id_type" value="'.$rowsvalues['session_name'].'" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Term <span class="required">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="id_type" id="id_type" value="'.get_term($rowsvalues['id_term']).'" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Exam Type <span class="required">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="id_type" id="id_type" value="'.$rowsvalues['type_name'].'" readonly />
								</div>
							</div>
							<div class="form-group mb-md">
								<label class="col-md-3 control-label">Comment</label>
								<div class="col-md-9">
									<textarea class="form-control" rows="2" name="comment" id="comment" readonly>'.$rowsvalues['comment'].'</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Received <span class="required">*</span></label>
								<div class="col-md-9">
									<div class="radio-custom radio-inline">
										<input type="radio" id="receive_status" name="receive_status" value="1"'; if($rowsvalues['receive_status'] == 1) {echo'checked';} echo'>
										<label for="radioExample1">Yes</label>
									</div>
									<div class="radio-custom radio-inline">
										<input type="radio" id="receive_status" name="receive_status" value="2"'; if($rowsvalues['receive_status'] == 2) {echo'checked';} echo'>
										<label for="radioExample1">No</label>
									</div>
								</div>
							</div>
						</div>
						<footer class="panel-footer">
							<div class="row">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn btn-primary" id="changes_paperReceive" name="changes_paperReceive">Update</button>
									<button class="btn btn-default modal-dismiss">Cancel</button>
								</div>
							</div>
						</footer>
					</form>
				</section>
			</div>
		</div>';
	}
	else
	{

	}

}
?>