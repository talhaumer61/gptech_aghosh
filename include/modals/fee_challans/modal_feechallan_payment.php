<?php
//---------------------------------------------------------
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
checkCpanelLMSALogin();
//---------------------------------------------------------
if($_SESSION['userlogininfo']['LOGINIDA']  == 4){ 
	// Query get data
	$sqllms	= $dblms->querylms("SELECT  f.id, f.status, f.id_type, f.id_month, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std,
								   f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
								   c.class_id, c.class_name,
								   cs.section_id, cs.section_name,
								   s.session_id, s.session_name,
								   st.std_id, st.std_name, st.std_regno, st.std_phone
								   FROM ".FEES." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   INNER JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND f.id = '".cleanvars($_GET['id'])."'
								   ORDER BY f.challan_no DESC");
	$rowsvalues = mysqli_fetch_array($sqllms);
	

	// //------- Select Remaining Amount --------------
	// $sqlRemaining = $dblms->querylms("SELECT amount
	// 									FROM ".FEE_PARTICULARS."
	// 									WHERE id_fee = '".cleanvars($_GET['id'])."'
	// 										AND id_cat = '13' LIMIT 1");
	// $valReamining = mysqli_fetch_array($sqlRemaining);
	// //------------------------------------------------
	// $remainingAmount = $valReamining['amount'];
	// //-----------------------------------------------------
	$remainingAmount = 0;

	if(date('Y-m-d') > $rowsvalues['due_date']) {
		$granTotal = $rowsvalues['total_amount'] + LATEFEE;
	} else {
		$granTotal = $rowsvalues['total_amount'];
	}

	echo'
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<div class="row">
		<div class="col-md-12">
			<section class="panel panel-featured panel-featured-primary">
				<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
					<input type="hidden" name="id_fee" id="id_fee" value="'.cleanvars($_GET['id']).'">
					<input type="hidden" name="challan_no" id="challan_no" value="'.$rowsvalues['challan_no'].'">
					<input type="hidden" name="std_phone" id="std_phone" value="'.$rowsvalues['std_phone'].'">
					<input type="hidden" name="id_std" id="id_std" value="'.$rowsvalues['id_std'].'">
					<input type="hidden" name="id_month" id="id_month" value="'.$rowsvalues['id_month'].'">
					<input type="hidden" name="dueDate" id="dueDate" value="'.$rowsvalues['due_date'].'">
					<header class="panel-heading">
						<h2 class="panel-title"><i class="glyphicon glyphicon-compressed"></i> Fee Challan Payment</h2>
					</header>
					<div class="panel-body">
						<div class="form-group">
							<div class="col-md-12">
								<div class="row clearfix">
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Student <span class="required">*</span></label>
												<input type="text" class="form-control" required title="Must Be Required" value="'.$rowsvalues['std_name'].'" readonly/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Class <span class="required">*</span></label>
												<input type="text" class="form-control" required title="Must Be Required" value="'.$rowsvalues['class_name'].'"'; if($rowsvalues['section_name']){echo'( '.$rowsvalues['section_name'].' )';} echo'" readonly/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Challan No <span class="required">*</span></label>
												<input type="text" class="form-control" required title="Must Be Required" id="challan_no" value="'.$rowsvalues['challan_no'].'" readonly/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="row clearfix">
									<div class="col-md-4">
										<label class="control-label">For Month <span class="required">*</span></label>
										<input type="text" class="form-control" required title="Must Be Required" value="'.get_monthtypes(cleanvars($rowsvalues['id_month'])).'" readonly/>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Issue Date <span class="required">*</span></label>
												<input type="text" class="form-control" required title="Must Be Required" value="'.date('m-d-Y' , strtotime(cleanvars($rowsvalues['issue_date']))).'" readonly/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Due Date <span class="required">*</span></label>
												<input type="text" id="due_date" name="due_date" class="form-control" required title="Must Be Required" value="'.date('m-d-Y' , strtotime(cleanvars($rowsvalues['due_date']))).'" readonly/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-12">
										<label class=control-label">Paid Date <span class="required">*</span></label>
										<input type="text" id="paid_date" name="paid_date" class="form-control" data-plugin-datepicker required title="Must Be Required" />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label class="control-label">Paid Amount </label>
								<input type="text" id="paid_amount" name="paid_amount" value="'.$granTotal.'" required class="form-control paid"/>
							</div>
							<div class="col-md-4">
								<label class="control-label">Mode of Payment <span class="required">*</span></label>
								<select class="form-control" data-plugin-selectTwo data-width="100%" name="pay_mode">
									<option value="">Select</option>';
									foreach($paymethod as $method){
										echo '<option value="'.$method['id'].'">'.$method['name'].'</option>';
									}
									echo'
								</select>
							</div>
							
						</div>
						
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Note </label>
								<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button type="submit" class="btn btn-primary" onClick=\'return confirmPayment()\' id="challan_payment" name="challan_payment">Payment</button>
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

<script type="text/javascript">
	function confirmPayment() {
		var agree=confirm("Are you sure you want to Pay this Challan?");
		if (agree)
		return true ;
		else
		return false ;
	}
</script>