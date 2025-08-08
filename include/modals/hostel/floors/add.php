<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '31', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_floor" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="hostelFloors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Hostel Floor</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Floor <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="floor_name" id="floor_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required" name="id_hostel">
							<option value="">Select</option>';
							//-----------------------------------------------------
							$sqllms	= $dblms->querylms("SELECT hostel_id, hostel_name
															   FROM ".HOSTELS."
															   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															   AND hostel_status = '1' AND is_deleted != '1'
															   ORDER BY hostel_name ASC");
							while($rowsvalues = mysqli_fetch_array($sqllms)) {
								echo'<option value="'.$rowsvalues['hostel_id'].'">'.$rowsvalues['hostel_name'].'</option>';
							}
							//-----------------------------------------------------
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="floor_status" name="floor_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="floor_status" name="floor_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_floor" name="submit_floor">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>