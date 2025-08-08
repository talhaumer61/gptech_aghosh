<?php 
//---------------------------------------------------------
   include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '43', 'edit' => '1'))){
	//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  v.id, v.status, v.id_purpose, v.card_no, v.name, v.phone, v.email, v.cnic, v.num_of_person, v.dated, v.time_in, v.time_out, v.note
								   		FROM ".VISITOR." v  
										WHERE v.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND v.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
	//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="visitors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Visitors</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Purpose Name <span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_purpose">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT purpose_id, purpose_name 
													FROM ".VISITOR_PURPOSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY purpose_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['purpose_id'] == $rowsvalues['id_purpose']) { 
							  echo '<option value="'.$valuecls['purpose_id'].'" selected>'.$valuecls['purpose_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['purpose_id'].'">'.$valuecls['purpose_name'].'</option>';
						  }
					  }
						echo '
						</select>
					</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Card No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="card_no" id="card_no" required title="Must Be Required" value="'.$rowsvalues['card_no'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" required title="Must Be Required" value="'.$rowsvalues['name'].'" />
				</div>
			</div>
				<div class="form-group mt-sm">
				<label class="col-md-3 control-label"> Phone <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="phone" id="phone" required title="Must Be Required" value="'.$rowsvalues['phone'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Email <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="email" id="email" required title="Must Be Required" value="'.$rowsvalues['email'].'" />
				</div>
			</div>
				<div class="form-group mt-sm">
				<label class="col-md-3 control-label">CNIC <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="cnic" id="cnic" required title="Must Be Required" value="'.$rowsvalues['cnic'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Num Of Person <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="num_of_person" id="num_of_person" required title="Must Be Required" value="'.$rowsvalues['num_of_person'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated" required data-plugin-datepicker  title="Must Be Required" value="'.$rowsvalues['dated'].'" />
				</div>
			</div>
			<div class="form-group mb-md">
					<label class="col-md-3 control-label">Visit Time from  <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-timerange input-group">
							<span class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</span>
							<input type="text" class="form-control valid" name="time_in" id="time_in" value="'.$rowsvalues['time_in'].'" required  data-plugin-timepicker title="Must Be Required" aria-required="true">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name="time_out" id="time_out" value="'.$rowsvalues['time_in'].'" required data-plugin-timepicker title="Must Be Required"  aria-required="true">
						</div>
					</div>
				</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Note<span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="note" id="note" required title="Must Be Required">'.$rowsvalues['note'].'</textarea>
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
					<button type="submit" class="btn btn-primary" id="changes_visitor" name="changes_visitor">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}