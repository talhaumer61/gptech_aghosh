l;<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '37', 'edit' => '1'))){ 
	$sqllms	= $dblms->querylms("SELECT  v.id, v.status, v.name, v.phone, v.dated, v.detail, v.next_followupdate, v.duration, v.note, v.call_type
								   		FROM ".CALLLOG." v  
										WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND v.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//-------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="call_log.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Calllog</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" required title="Must Be Required" value="'.$rowsvalues['name'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="phone" id="phone" required title="Must Be Required" value="'.$rowsvalues['phone'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated"  data-plugin-datepicker required title="Must Be Required" value="'.$rowsvalues['dated'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="detail" id="detail" required title="Must Be Required" value="'.$rowsvalues['detail'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Followup Date <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="next_followupdate" id="next_followupdate"  data-plugin-datepicker required title="Must Be Required" value="'.$rowsvalues['next_followupdate'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Duration <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="duration" id="duration" required title="Must Be Required" value="'.$rowsvalues['duration'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Note <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="note" id="note" required title="Must Be Required" value="'.$rowsvalues['note'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Call Type <span class="required">*</span></label>
				<div class="col-md-9">
					<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="call_type">
					  		<option value="call_type">'.get_calltypes($rowsvalues['call_type']).'</option>
					  		<option value="1">Incoming</option>
					  		<option value="2">Out Going</option>
					   </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_call" name="changes_call">Update</button>
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