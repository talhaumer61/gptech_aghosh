<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT r.route_id, r.route_status, r.route_name,r.route_startplace, r.route_endplace, r.route_fare, r.route_detail
								   		FROM ".ROUTES." r  
										WHERE r.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND r.route_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="transport_routes.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="route_id" id="route_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Route </h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Route Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="route_name" id="route_name" required title="Must Be Required" value="'.$rowsvalues['route_name'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Startplace <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="route_startplace" id="route_startplace" required title="Must Be Required" value="'.$rowsvalues['route_startplace'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Endplace <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="route_endplace" id="route_endplace" required title="Must Be Required" value="'.$rowsvalues['route_endplace'].'" />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Route Fare <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="route_fare" id="route_fare" required title="Must Be Required" value="'.$rowsvalues['route_fare'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="route_detail" id="route_detail" required title="Must Be Required">'.$rowsvalues['route_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['route_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="route_status" name="route_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="route_status" name="route_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['route_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="route_status" name="route_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="route_status" name="route_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_route" name="changes_route">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------