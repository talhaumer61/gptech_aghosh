<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '8', 'edit' => '1'))){
//----------------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  p.period_id, p.period_status, p.period_name, p.period_timestart, p.period_timeend   
									FROM ".PERIODS." p  
									WHERE p.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
									AND p.period_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="timetable_period.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="period_id" id="period_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Period</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Period Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="period_name" id="period_name" required title="Must Be Required" value="'.$rowsvalues['period_name'].'" />
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Period Time From  <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="input-timerange input-group">
						<span class="input-group-addon">
							<i class="fa fa-clock-o"></i>
						</span>
						<input type="text" class="form-control valid" name="period_timestart" id="period_timestart" value="'.$rowsvalues['period_timestart'].'" required  data-plugin-timepicker title="Must Be Required">
						<span class="input-group-addon">to</span>
						<input type="text" class="form-control" name = "period_timeend" id="period_timeend"  value="'.$rowsvalues['period_timeend'].'" required data-plugin-timepicker title="Must Be Required">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['period_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="period_status" name="period_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="period_status" name="period_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['period_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="period_status" name="period_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="period_status" name="period_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_timetable" name="changes_timetable">Update</button>
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