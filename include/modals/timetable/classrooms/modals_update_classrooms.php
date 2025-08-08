<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
	if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '7', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  cr.room_id,cr.room_status,cr.room_no,cr.room_capacity  
								   		FROM ".CLASS_ROOMS." cr  
										WHERE cr.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND cr.room_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="timetable_classrooms.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="room_id" id="room_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Classroom</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Room No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="room_no" id="room_no" required title="Must Be Required" value="'.$rowsvalues['room_no'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Room Capacity <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="room_capacity" id="room_capacity" required title="Must Be Required" value="'.$rowsvalues['room_capacity'].'" />
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
					<button type="submit" class="btn btn-primary" id="changes_classrooms" name="changes_classrooms">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>