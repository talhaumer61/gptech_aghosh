<?php
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2)|| Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '22', 'updated' => '1'))){ 
echo'
<div id="add_account" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="panel-heading">
			<h2 class="panel-title">
				<i class="fa fa-plus-square"></i>	Add Bank Account</h2>
		</div>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Bank Name <span class="required">*</span></label>
				<div class="col-md-9">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_bank">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT bank_id, bank_name 
													FROM ".BANKS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY bank_name ASC");
					while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['bank_id'].'">'.$valuecls['bank_name'].'</option>';
					}
			echo '
				</select>
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_name" required title="Must Be Required"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Branch <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="branch" required title="Must Be Required"/>
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
					<input type="text" class="form-control" name="account_type" required title="Must Be Required"/>
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_no" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1" checked>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2">
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit_account" name="submit_account" class="btn btn-primary">Save</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
		</form>	</section>
</div>';
}
?>