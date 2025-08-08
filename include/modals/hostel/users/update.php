<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'edit' => '1'))){ 
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT id, status, type, id_std, id_hostel, id_floor, id_room, monthly_fee, joining_date, leaving_date
								FROM ".HOSTEL_REG." 
								WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								AND id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
		<form action="hostelUsers.php" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Registration</h2>
			</header>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Hostel <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_hostel">
						<option value="">Select</option>';
						$sqllmsHOstel = $dblms->querylms("SELECT hostel_id, hostel_name 
													FROM ".HOSTELS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND hostel_status = '1' AND is_deleted != '1'
													ORDER BY hostel_name ASC");
						while($valueHostel = mysqli_fetch_array($sqllmsHOstel)) {
							if($valueHostel['hostel_id'] == $rowsvalues['id_hostel']) { 
								echo '<option value="'.$valueHostel['hostel_id'].'" selected>'.$valueHostel['hostel_name'].'</option>';
							} else { 
								echo '<option value="'.$valueHostel['hostel_id'].'">'.$valueHostel['hostel_name'].'</option>';
							}
						}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Floor <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_floor">
							<option value="">Select</option>';
								$sqllmsFloor = $dblms->querylms("SELECT floor_id, floor_name 
															FROM ".HOSTEL_FLOORS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
															AND floor_status = '1' AND is_deleted != '1'
															ORDER BY floor_name ASC");
								while($valueFloor = mysqli_fetch_array($sqllmsFloor)) {
									if($valueFloor['floor_id'] == $rowsvalues['id_floor']) { 
										echo '<option value="'.$valueFloor['floor_id'].'" selected>'.$valueFloor['floor_name'].'</option>';
									} else{ 
										echo '<option value="'.$valueFloor['floor_id'].'">'.$valueFloor['floor_name'].'</option>';
									}
								}
							echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Room <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_room">
							<option value="">Select</option>';
							$sqllmsRooms = $dblms->querylms("SELECT room_id, room_name 
														FROM ".HOSTEL_ROOMS."
														WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
														AND room_status = '1' AND is_deleted != '1'
														ORDER BY room_name ASC");
							while($valueRoom = mysqli_fetch_array($sqllmsRooms)) {
								if($valueRoom['room_id'] == $rowsvalues['id_room']) { 
										echo '<option value="'.$valueRoom['room_id'].'" selected>'.$valueRoom['room_name'].'</option>';
									} else{ 
										echo '<option value="'.$valueRoom['room_id'].'">'.$valueRoom['room_name'].'</option>';
									}
								}
							echo '
						</select>
					</div>
				</div>
				<!-- <div class="form-group">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" required title="Must Be Required" data-minimum-results-for-search="Infinity" name="id_type">
							<option value="">Select</option>';
								foreach($userType as $type) { 
									echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
								}
						echo '
						</select>
					</div>
				</div>-->
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" name="id_std" disabled>';
							$sqllmsstudent	= $dblms->querylms("SELECT std_id, std_name
																	FROM ".STUDENTS." 
																	WHERE std_id = '".$rowsvalues['id_std']."'
																	AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'");
							$valueStd = mysqli_fetch_array($sqllmsstudent);
							echo '<option value="'.$valueStd['std_id'].'" selected>'.$valueStd['std_name'].'</option>';
							echo'
						</select>
					</div>
				</div>
				<input type="hidden" name="id_std" id="id_std" value="'.cleanvars($valueStd['std_id']).'">
				<!-- <div class="form-group">
					<label class="col-md-3 control-label">Monthly Fee <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" required title="Must Be Required" name="monthly_fee" id="monthly_fee" value="'.$rowsvalues['monthly_fee'].'"/>
					</div>
				</div> -->
				<div class="form-group">
					<label class="col-md-3 control-label">Joining Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="joining_date" id="joining_date"'; if($rowsvalues['joining_date'] != "0000-00-00"){echo' value="'.date('m/d/Y' , strtotime(cleanvars($rowsvalues['joining_date']))).'"';} echo'data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Leave Date </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="leaving_date" id="leaving_date"'; if($rowsvalues['leaving_date'] != "0000-00-00"){echo'value="'.date('m/d/Y' , strtotime(cleanvars($rowsvalues['leaving_date']))).'"';} echo' data-plugin-datepicker />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
						foreach($regStatus as $status){
							echo'
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="'.$status['id'].'"'; if($status['id'] == $rowsvalues['status']){echo'checked';} echo'>
								<label for="radioExample1">'.$status['name'].'</label>
							</div>';
						}
						echo'
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="chnages_registration" name="chnages_registration">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
		</section>
    </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$("form#frm").validate({
			rules: {
				room_beds: {
					number: true
				},
				room_bedfee: {
					number: true
				}
			},

			messages: {
				room_beds: {
					number: \'Please enter a valid number.\'
				},

				room_bedfee: {
					number: \'Please enter a valid number.\'
				}
			},

			errorPlacement: function (error, element) {
				var placement = element.closest(\'.input-group\');
				if (!placement.get(0)) {
					placement = element;
				}
				if (error.text() !== \'\') {
					if (element.parent(\'.checkbox, .radio\').length || element.parent(\'.input-group\').length) {
						placement.after(error);
					} else {
						var placement = element.closest(\'div\');
						placement.append(error);
						wrapper: "li"
					}
				}
			}
		});
	});
</script>';
}
?>
