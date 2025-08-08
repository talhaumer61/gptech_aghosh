<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT s.store_id, s.store_status, s.store_name, s.store_code, s.store_detail 
								   FROM ".INVENTORY_STORES." s 
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'  
								   AND s.store_id = '".cleanvars($_GET['id'])."'
								   ORDER BY s.store_name ASC");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '42', 'updated' => '1'))){ 
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="stationary-item.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="store_id" id="store_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Stationary Item</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Store Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="store_name" id="store_name" required title="Must Be Required" value="'.$rowsvalues['store_name'].'" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Store Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input class="form-control" rows="3" id="store_code" name="store_code" value="'.$rowsvalues['store_code'].'"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Store Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea class="form-control" rows="3" id="store_detail" name="store_detail">'.$rowsvalues['store_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['store_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="store_status" name="store_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="store_status" name="store_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['store_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="store_status" name="store_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="store_status" name="store_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_store" name="changes_store">Update</button>
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