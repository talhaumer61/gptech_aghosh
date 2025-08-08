<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_hostel_room" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<header class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Hostel Room</h2>
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
		<div class="form-group mt-sm">
			<label class="col-md-3 control-label">Room No <span class="required">*</span></label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="room_name" id="room_name" required title="Must Be Required"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Type <span class="required">*</span></label>
			<div class="col-md-9">
				<select class="form-control" required data-plugin-selectTwo data-width="100%" required title="Must Be Required" data-minimum-results-for-search="Infinity" name="room_type">
					<option value="">Select</option>';
						foreach($userType as $type) { 
							echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">No Of Beds <span class="required">*</span></label>
			<div class="col-md-9">
				<input type="text" class="form-control" required title="Must Be Required" name="room_beds" id="room_beds"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Per Bed Fee <span class="required">*</span></label>
			<div class="col-md-9">
				<input type="text" class="form-control" required title="Must Be Required" name="room_bedfee" id="room_bedfee"/>
			</div>
		</div>
		<div class="form-group mb-md">
			<label class="col-md-3 control-label">Description</label>
			<div class="col-md-9">
				<textarea class="form-control" rows="2" name="room_detail" id="room_detail"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
			<div class="col-md-9">
				<div class="radio-custom radio-inline">
					<input type="radio" id="room_status" name="room_status" value="1" checked>
					<label for="radioExample1">Active</label>
				</div>
				<div class="radio-custom radio-inline">
					<input type="radio" id="room_status" name="room_status" value="2">
					<label for="radioExample2">Inactive</label>
				</div>
			</div>
		</div>
		
	</div>
	<footer class="panel-footer">
		<div class="row">
			<div class="col-md-12 text-right">
				<button type="submit" class="btn btn-primary" id="submit_room" name="submit_room">Save</button>
				<button class="btn btn-default modal-dismiss">Cancel</button>
			</div>
		</div>
	</footer>
</form>
</section>
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