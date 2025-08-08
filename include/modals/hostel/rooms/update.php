<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'edit' => '1'))){ 
//---------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT room_id, room_status, room_name, room_type, room_beds, room_bedfee, room_detail, id_hostel, id_floor 
									FROM ".HOSTEL_ROOMS." 
									WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND room_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
		<form action="hostelrooms.php" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<input type="hidden" name="room_id" id="room_id" value="'.cleanvars($_GET['id']).'">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Hostel Room</h2>
			</header>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Hostel Name <span class="required">*</span></label>
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
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_hostel">
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
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Room Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="room_name" id="room_name" value="'.$rowsvalues['room_name'].'" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" required title="Must Be Required" data-minimum-results-for-search="Infinity" name="id_type">
							<option value="">Select</option>';
								foreach($userType as $type) { 
									if($type['id'] == $rowsvalues['room_type']){
										echo'<option value="'.$type['id'].'" selected>'.$type['name'].'</option>';
									} else{
										echo'<option value="'.$type['id'].'">'.$type['name'].'</option>';
									}
								}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">No Of Beds <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" required value="'.$rowsvalues['room_beds'].'" title="Must Be Required" name="room_beds" id="room_beds"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Bed Fee <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" required value="'.$rowsvalues['room_bedfee'].'" title="Must Be Required" name="room_bedfee" id="room_bedfee"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name= "room_detail" id="room_detail">'.$rowsvalues['room_detail'].'</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
				if($rowsvalues['room_status'] == 1) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="room_status" name="room_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="room_status" name="room_status" value="1">
							<label for="radioExample1">Active</label>
						</div>';
				}
				if($rowsvalues['room_status'] == 2) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="room_status" name="room_status" checked value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="room_status" name="room_status" value="2">
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
						<button type="submit" class="btn btn-primary" id="changes_room" name="changes_room">Update</button>
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
