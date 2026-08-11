<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '32', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_hostel_registration" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="hostelUsers.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Registration</h2>
			</header>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Hostel <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_hostel">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT hostel_id, hostel_name 
															FROM ".HOSTELS."
															WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															AND hostel_status = '1' AND is_deleted != '1'
															ORDER BY hostel_name ASC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['hostel_id'].'">'.$valuecls['hostel_name'].'</option>';
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
								echo '<option value="'.$valueFloor['floor_id'].'">'.$valueFloor['floor_name'].'</option>';
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
								echo '<option value="'.$valueRoom['room_id'].'">'.$valueRoom['room_name'].'</option>';
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
				</div> -->
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classstudent(this.value)">
							<option value="">Select</option>';
							$sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES." 
																	WHERE class_status = '1' ORDER BY class_id ASC");
							while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
							echo '<option value="'.$value_class['class_id'].'">'.$value_class['class_name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<div id="getclassstudent">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" name="id_std">
								<option value="">Select</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Joining Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="joining_date" id="joining_date" data-plugin-datepicker required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Leave Date </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="leaving_date" id="leaving_date" data-plugin-datepicker />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
						foreach($regStatus as $status){
							echo'
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="'.$status['id'].'"'; if($status['id'] == 1){echo'checked';} echo'>
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
						<button type="submit" class="btn btn-primary" id="make_registration" name="make_registration">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>