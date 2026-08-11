<?php 
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2)|| Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '22', 'updated' => '1'))){ 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT a.id, a.status, a.id_emply, a.id_bank, a.branch, a.account_name,
										a.account_no, a.account_type,
										b.bank_id, b.bank_name,
										e.emply_id, e.emply_name
									FROM ".EMPLOYEES_BANKACCOUNTS." a
									INNER JOIN ".BANKS." b ON b.bank_id = a.id_bank
									INNER JOIN ".EMPLOYEES." e ON e.emply_id = a.id_emply
									WHERE a.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
									AND   a.id_emply = '".cleanvars($_GET['id'])."' 
									ORDER BY a.account_name ASC ");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="emply_id" id="emply_id" value="'.cleanvars($_GET['id']).'">
	<input type="hidden" name="id" id="id" value="'.$rowsvalues['id'].'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Account</h2>
		</header>
		<div class="panel-body">
				<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Bank Name <span class="required">*</span></label>
				<div class="col-md-9">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_bank">
					<option value="">Select</option>';
						$sqllmsbank	= $dblms->querylms("SELECT bank_id, bank_name 
													FROM ".BANKS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY bank_name ASC");
					while($valuebank = mysqli_fetch_array($sqllmsbank)) {
						echo '<option value="'.$valuebank['bank_id'].'"'; if($valuebank['bank_id'] == $rowsvalues['id_bank']) {echo ' selected';} echo'>'.$valuebank['bank_name'].'</option>';
					}
			echo '
				</select>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_name" id="account_name" required title="Must Be Required" value="'.$rowsvalues['account_name'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Branch <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="branch" id="branch" required title="Must Be Required" value="'.$rowsvalues['branch'].'" />
				</div>
			</div>
			
			
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Employee <span class="required">*</span></label>
				<div class="col-md-9">';
				$sqllmscls	= $dblms->querylms("SELECT emply_id, emply_name 
													FROM ".EMPLOYEES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND emply_id = '".cleanvars($_GET['id'])."'
													ORDER BY emply_name ASC");
					while($valuecls = mysqli_fetch_array($sqllmscls)) {
					echo'
					<input type="hidden" class="form-control" name="id_emply" value="'.$valuecls['emply_id'].'" readonly required title="Must Be Required"/>
					<input type="text" class="form-control" name="" value="'.$valuecls['emply_name'].'" readonly required title="Must Be Required"/>
					';
					}
					echo'
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account Type <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_type" value="'.$rowsvalues['account_type'].'" required title="Must Be Required"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_no" value="'.$rowsvalues['account_no'].'" required title="Must Be Required"/>
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
					<button type="submit" class="btn btn-primary" id="changes_account" name="changes_account">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
//---------------------------------------------------------