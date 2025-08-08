<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'edit' => '1'))){ 
//---------------------------------------------------------
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
	//-----------------------------------------------------

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
		$granTotal = $rowsvalues['total_amount'] + 300;
	} else {
		$granTotal = $rowsvalues['total_amount'];
	}

echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
		<input type="hidden" name="id_fee" id="id_fee" value="'.cleanvars($_GET['id']).'">
		<input type="hidden" name="challan_no" id="challan_no" value="'.$rowsvalues['challan_no'].'">
		<input type="hidden" name="std_phone" id="std_phone" value="'.$rowsvalues['std_phone'].'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fee Challan </h2>
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
									<input type="text" class="form-control" required title="Must Be Required" name="challan_no" id="challan_no" value="'.$rowsvalues['challan_no'].'" readonly/>
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
									<input type="text" id="due_date" name="due_date" class="form-control" data-plugin-datepicker required title="Must Be Required" value="'.date('m/d/Y' , strtotime(cleanvars($rowsvalues['due_date']))).'"'; if($rowsvalues['status'] == 1) {echo' readonly';}echo'/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
			echo'
			<div class="form-group mt-sm">
				<div class="col-md-12">
					<div class="row clearfix">';
						//--------------------------------------
						// $total_fee = 0;
							//------------------------------------------------
							$sqllmscats  = $dblms->querylms("SELECT cat_id, cat_name  
																	FROM ".FEE_CATEGORY."
																	WHERE cat_status = '1'
																	ORDER BY cat_id ASC");
							$countcats = mysqli_num_rows($sqllmscats);
							//--------------------------------------
							if($countcats >0) {
								$src = 0;
								$scholarshipConcession = 0;
								$fine = 0;
								while($rowdoc 	= mysqli_fetch_array($sqllmscats)) {
									//------------------------------------
									$sqllmsfeeprt  = $dblms->querylms("SELECT id, id_cat, amount 
																			FROM ".FEE_PARTICULARS." 
																			WHERE id_cat = '".$rowdoc['cat_id']."' AND id_fee  = '".$rowsvalues['id']."'
																			LIMIT 1");
									if(mysqli_num_rows($sqllmsfeeprt) > 0) { 
										$valuefeeprt = mysqli_fetch_array($sqllmsfeeprt);
										echo'
										<div class="col-md-4">
											<div class="form-group mt-sm">
												<div class="col-md-12">
													<label class=control-label">'.$rowdoc['cat_name'].' <span class="required">*</span></label>
													<input type="hidden" name="id[]" value="'.$valuefeeprt['id'].'">
													<input type="hidden" name="id_cat[]" value="'.$rowdoc['cat_id'].'">
													<input type="number" value="'.$valuefeeprt['amount'].'"'; 
														if($rowdoc['cat_id'] == 13){
															echo'id="remaining_amount" name="remaining_amount" class="form-control remaining"';
															$remainingAmount = $valuefeeprt['amount'];
														} else{echo'id="amount" name="amount[]" class="form-control" required title="Must Be Required" readonly';}
														echo'/>
												</div>
											</div>
										</div>';
									} elseif($rowdoc['cat_id'] == 13){
										echo'
										<div class="col-md-4">
											<div class="form-group mt-sm">
												<div class="col-md-12">
													<label class=control-label">'.$rowdoc['cat_name'].' <span class="required">*</span></label>
													<input type="text" id="remaining_amount" name="remaining_amount" class="form-control remaining"/>
												</div>
											</div>
										</div>';
									}
								}
							}
							echo'
					</div>
				</div>
			</div>';

			//---------------- Online Payment ----------------------
			$sqllmsOnlinePay = $dblms->querylms("SELECT SUM(trans_amount) as total_paid
											FROM ".PAY_API_TRAN." 
											WHERE challan_no = '".cleanvars($rowsvalues['challan_no'])."'");
			$onlinePaid = mysqli_fetch_array($sqllmsOnlinePay);
			// if($onlinePaid['total_paid'] >= $rowsvalues['total_amount']){
			// 	$status = '1';
			// }elseif($onlinePaid['total_paid'] < $rowsvalues['total_amount'] && $onlinePaid['total_paid'] != 0){
			// 	$status = 4;
			// } else{

			// 	$status = $rowsvalues['status'];
			// }
			//-----------------------------------------------------
			echo'
			<div class="form-group">';
				$onlineTotalPaid = 0;
				if($onlinePaid['total_paid'] > 0){
					$col = "col-md-4";
					echo'
					<div class="'.$col.'">
						<label class="control-label">Partial Paid </label>
						<input type="text" id="partial_paid" name="partial_paid" value="'.$onlinePaid['total_paid'].'" class="form-control" readonly/>
					</div>';
					$onlineTotalPaid = $onlinePaid['total_paid'];
				}else{
					$col = "col-md-6";
				}
				//---------------------------------
				$totalAmount = $rowsvalues['total_amount'] - ($remainingAmount + $onlineTotalPaid);
				
				//---------------------------------
				echo'
				
				<input type="hidden" id="totAmount" name="totAmount" required title="Must Be Required" value="'.$totalAmount.'" readonly/>

				<div class="'.$col.'">
					<label class="control-label">Payable <span class="required">*</span></label>
					<input type="hidden" id="payable" name="payable" class="totalPayable"  required title="Must Be Required" value="'.$rowsvalues['total_amount'].'" readonly/>
					<input type="text" id="" name="" class="form-control totalPayable" required title="Must Be Required" value="'.$granTotal.'" readonly/>
				</div>
				<div class="'.$col.'">
					<label class="control-label">Pay Mode </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="pay_mode" name="pay_mode">
						<option value="">Select</option>';
						foreach($paymethod as $method){
							echo'<option value="'.$method['id'].'">'.$method['name'].'</option>';
						}
						echo '
					</select>
				</div>
			</div>
			<!--
			<div class="col-md-6">
				<label class="control-label">Paid Amount </label>
				<input type="text" id="paid_amount" name="paid_amount" class="form-control paid"/>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Rem. Amount </label>
					<input type="text" id="remaining_amount" name="remaining_amount" class="form-control" readonly/>
				</div>
			</div> -->
			<div class="form-group mb-md">
				<div class="col-md-12">
					<label class="control-label">Note </label>
					<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Status <span class="required">*</span></label>
				<div class="col-md-10">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowsvalues['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Paid</label>
					</div>'; 
					if($rowsvalues['status'] != 4 ) {echo' 
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowsvalues['status'] == 2) {echo' checked';}echo'>
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
					<button type="submit" class="btn btn-primary" id="changes_challan" name="changes_challan">Update</button>
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
$(document).on("change", ".remaining", function() {
	var remaining = document.getElementById("remaining_amount").value;
	var totAmount =  document.getElementById("totAmount").value;

	var totalPayable  = ((totAmount * 1) + (remaining * 1));
	$(".totalPayable").val(totalPayable);
});
</script>