<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '81', 'edit' => '1'))){ 
//---------------------------------------------------------
	
	$sqllmsChallan	= $dblms->querylms("SELECT  f.id, f.status, f.challan_no,
								   f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.remaining_amount, f.note, d.donor_name
								   FROM ".FEES." f				   
								   INNER JOIN ".DONORS." d ON d.donor_id = f.id_donor
								   WHERE f.challan_no = '".cleanvars($_GET['id'])."'
								   AND f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
	$rowChallan = mysqli_fetch_array($sqllmsChallan);

	// Paid Fot This Challan
	$sqllmsPaid = $dblms->querylms("SELECT SUM(trans_amount) as totalPaid
											FROM ".PAY_API_TRAN." 
											WHERE challan_no = '".cleanvars($rowChallan['challan_no'])."'");

	$valuePaid = mysqli_fetch_array($sqllmsPaid);

	if($valuePaid['totalPaid'] > 0) {
		$paidAmount = '
		<div class="form-group">
			<div class="col-md-12">
				<label class="control-label">Paid Amount <span class="required">*</span></label>
				<input type="text" id="paid" name="paid" class="form-control" value="'.$valuePaid['totalPaid'].'" required title="Must Be Required" readonly/>
			</div>
		</div>';
	} else {
		$paidAmount = '';
	}

echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="donationChallans.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<input type="hidden" name="challan_no" id="challan_no" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Donor Challan </h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<div class="col-md-12">
					<div class="row clearfix">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-12">
									<label class=control-label">Donor <span class="required">*</span></label>
									<input type="text" class="form-control" required title="Must Be Required" value="'.$rowChallan['donor_name'].'" readonly/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-12">
									<label class=control-label">Challan No <span class="required">*</span></label>
									<input type="text" class="form-control" required title="Must Be Required" name="challan_no" id="challan_no" value="'.$rowChallan['challan_no'].'" readonly/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group mt-sm">
				<div class="col-md-12">
					<div class="row clearfix">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-12">
									<label class=control-label">Issue Date <span class="required">*</span></label>
									<input type="text" class="form-control" required title="Must Be Required" value="'.date('m-d-Y' , strtotime(cleanvars($rowChallan['issue_date']))).'" readonly/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-12">
									<label class=control-label">Due Date <span class="required">*</span></label>
									<input type="text" id="due_date" name="due_date" class="form-control" data-plugin-datepicker required title="Must Be Required" value="'.date('m-d-Y' , strtotime(cleanvars($rowChallan['due_date']))).'"'; if($rowChallan['status'] == 1) {echo' readonly';}echo'/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Total Amount <span class="required">*</span></label>
					<input type="text" id="payable" name="payable" class="form-control" value="'.$rowChallan['total_amount'].'" required title="Must Be Required" readonly/>
				</div>
			</div> 
			'.$paidAmount.'
			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Remaining Amount <span class="required">*</span></label>
					<input type="text" id="remaining" name="remaining" class="form-control" value="'.($rowChallan['total_amount'] - $valuePaid['totalPaid']).'" required title="Must Be Required" readonly/>
				</div>
			</div>
			<div class="form-group mb-md">
				<div class="col-md-12">
					<label class="control-label">Note </label>
					<textarea class="form-control" rows="2" name="note" id="note">'.$rowChallan['note'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Status <span class="required">*</span></label>
				<div class="col-md-10">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowChallan['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Paid</label>
					</div>'; 
					if($rowChallan['status'] != 1) {
						echo ' 
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2"'; if($rowChallan['status'] == 2) {echo' checked';}echo'>
							<label for="radioExample2">Pending</label>
						</div>';
					}
					echo '
				</div>
			</div>
					
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="update_donor_challan" name="update_donor_challan">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel </button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>