<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT v.trans_id, v.trans_name, v.trans_cat, v.trans_amount, 
										v.trans_note, v.vouchar_no, v.trans_method
								   FROM ".HOSTEL_TYPES." v 
								   WHERE h.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND v.trans_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="account.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="trans_id" id="trans_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Voucher</h2>
		</header>
		<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="trans_name" value="'.$rowsvalues['trans_name'].'" id="trans_name" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Category</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="trans_cat" value="'.$rowsvalues['trans_cat'].'" id="trans_cat" required title="Must Be Required"/>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Amount</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="trans_amount" value="'.$rowsvalues['trans_amount'].'" id="trans_amount" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Note</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="trans_note" value="'.$rowsvalues['trans_note'].'" id="trans_note" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Voucher ID</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="vouchar_no" value="'.$rowsvalues['vouchar_no'].'" id="vouchar_no" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label">Method <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['trans_method'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="trans_method" name="trans_method" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="trans_method" name="trans_method" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['trans_method'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="trans_method" name="trans_method" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="trans_method" name="trans_method" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_voucher" name="changes_voucher">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
//---------------------------------------------------------