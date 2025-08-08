<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '80', 'edit' => '1'))){
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT id, status, id_std, id_donor, amount, duration
									FROM ".DONATIONS_STUDENTS."
									WHERE id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
$totalAmount = $rowsvalues['amount'] * $rowsvalues['duration'];
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="donations.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Student Donation</h2>
		</header>
		<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Donor <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_donor">
							<option value="">Select</option>';
								$sqllmsDon	= $dblms->querylms("SELECT donor_id, donor_name 
													FROM ".DONORS."
													WHERE donor_status = '1' ORDER BY donor_name ASC");
								while($valueDon = mysqli_fetch_array($sqllmsDon)) {
									echo '<option value="'.$valueDon['donor_id'].'"'; if($rowsvalues['id_donor'] == $valueDon['donor_id']){echo'selected';} echo'>'.$valueDon['donor_name'].'</option>';
								}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classstudent(this.value)" disabled>
							<option value="">Select</option>';
							$sqllmsStd	= $dblms->querylms("SELECT std_id, std_name, std_regno
																	FROM ".STUDENTS." 
																	WHERE std_id = '".$rowsvalues['id_std']."'
																	LIMIT 1");
							while($valueStd = mysqli_fetch_array($sqllmsStd)) {
								echo '<option value="'.$valueStd['std_id'].'" selected>'.$valueStd['std_name'].' ('.$valueStd['std_regno'].')</option>';
							}
							echo '
						</select>
					</div>
				</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control amount" name="amount" id="amount" required title="Must Be Required" value="'.$rowsvalues['amount'].'" />
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Frequency <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control duration" name="duration" id="duration" required title="Must Be Required" value="'.$rowsvalues['duration'].'" />
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Total Amount <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" id="total_amount" name="total_amount" class="form-control total" value="'.$totalAmount.'" required title="Must Be Required" readonly/>
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
					<button type="submit" class="btn btn-primary" id="changes_donation" name="changes_donation">Update</button>
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
<script type="text/javascript">
	//------------- If Duration Change ------------------
	$(document).on("change", ".duration", function() {
		var amount =  document.getElementById("amount").value;
		var duration = document.getElementById("duration").value;
		var total  = amount * duration;
		$(".total").val(total);
	});
	//------------- If Amount Change ------------------
	$(document).on("change", ".amount", function() {
		var amount =  document.getElementById("amount").value;
		var duration = document.getElementById("duration").value;
		var total  = amount * duration;
		$(".total").val(total);
	});
</script>