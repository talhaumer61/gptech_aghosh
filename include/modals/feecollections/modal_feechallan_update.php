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
						</div>
						<div class="form-group">
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
																		echo'id="remaining_amount" name="remaining_amount" class="form-control remaining amount"';
																		$remainingAmount = $valuefeeprt['amount'];
																	}else
																	if($rowdoc['cat_id'] == 14){
																		echo' id="amount" name="fine" class="form-control fine amount" required title="Must Be Required" '.((in_array($_SESSION['userlogininfo']['LOGINIDA'], $FEE_CHALLAN_RIGHTS) && $rowdoc['cat_id'] == 14) ? '' : 'readonly').'';
																	}else{
																		echo'id="amount" name="amount[]" class="form-control amount" required title="Must Be Required" readonly';
																	}
																	echo'/>
															</div>
														</div>
													</div>';
												}
												// elseif($rowdoc['cat_id'] == 13){
												// 	echo'
												// 	<div class="col-md-4">
												// 		<div class="form-group mt-sm">
												// 			<div class="col-md-12">
												// 				<label class=control-label">'.$rowdoc['cat_name'].' <span class="required">*</span></label>
												// 				<input type="text" id="remaining_amount" name="remaining_amount" class="form-control remaining amount"/>
												// 			</div>
												// 		</div>
												// 	</div>';
												// }
											}
										}
										echo'
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="'.($rowsvalues['paid_amount']==0 ? 'col-md-12' : 'col-md-4').'">
								<label class="control-label">Total Amount <span class="required">*</span></label>
								<input type="text" id="" name="payable" class="form-control totalPayable" required title="Must Be Required" value="'.$granTotal.'" readonly/>
								<input type="hidden" id="payable" name="total_amount" class="totalPayable" required title="Must Be Required" value="'.$rowsvalues['total_amount'].'" readonly/>
							</div>
							';
							$onlineTotalPaid = 0;
							if($rowsvalues['paid_amount'] > 0){
								$onlineTotalPaid = $rowsvalues['paid_amount'];
								$totalRemAmount = $granTotal - ($onlineTotalPaid);
								echo'
								<div class="col-md-4">
									<label class="control-label">Partial Paid </label>
									<input type="text" id="partial_paid" name="partial_paid" value="'.$onlineTotalPaid.'" class="form-control" readonly/>
								</div>
								<div class="col-md-4">
									<label class="control-label">Remaining Amount <span class="required">*</span></label>
									<input type="text" class="form-control" id="rem_amount" required title="Must Be Required" value="'.$totalRemAmount.'" readonly/>
								</div>

								<input type="hidden" id="payable" name="paid_amount" title="Must Be Required" value="'.$rowsvalues['paid_amount'].'" readonly/>
								<input type="hidden" id="totAmount" name="totAmount" required title="Must Be Required" value="'.$totalRemAmount.'" readonly/>';
							}
							echo'
						</div>';

						$sqllmscheck = $dblms->querylms("SELECT f.id, f.challan_no
															FROM ".FEES." f						 
															INNER JOIN ".STUDENTS." st ON st.std_id = f.id_std
															WHERE f.id_type		= '2'
															AND f.status		= '2'
															AND f.is_deleted	= '0'
															AND f.id_std		= '".cleanvars($rowsvalues['std_id'])."'
															AND st.is_deleted	= '0'
															AND f.id_campus		= '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
															ORDER BY f.id DESC LIMIT 1");
						$valuesqllmscheck = mysqli_fetch_array($sqllmscheck);

						if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
							echo'
							<div class="table-responsive">
								<table class="table table-bordered table-striped mb-none">
									<thead>
										<tr>
											<th class="center">Month</th>
											<th class="center">Challan</th>
											<th class="center">Due Date</th>
											<th class="center">Payable</th>
										</tr>
									</thead>
									<tbody>';
									$grandTotal = 0;
									foreach ($monthtypes as $month):
										// CURRENT MONTH
										if($rowsvalues['id_month']==$month['id']){
											$narChallan = $rowsvalues['challan_no'];
											$amount = $rowsvalues['total_amount'] - $rowsvalues['paid_amount'];

											if($rowsvalues['due_date'] < date('Y-m-d')){
												$amount = $amount + LATEFEE;
											}

											echo'
											<tr>
												<td>'.$month['name'].' '.$year.'</td>
												<td style="text-align:center;">'.$narChallan.'</td>
												<td style="text-align:center;">'.$rowsvalues['due_date'].'</td>
												<td style="text-align:right;">'.number_format($amount).'</td>
											</tr>';
										}
										
										// PREVIOUS MONTHS
										else{
											$sqlnarration  = $dblms->querylms("SELECT f.id, f.id_month, f.challan_no, f.id_std,
																				f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount
																				FROM ".FEES." f
																				WHERE f.id_campus	= '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																				AND f.id_month		= '".cleanvars($month['id'])."'
																				AND f.id_std		= '".cleanvars($rowsvalues['id_std'])."'
																				AND f.id_type		= '2'
																				AND (f.status = '2' OR f.status = '4')
																				AND f.is_deleted	= '0'
																				LIMIT 1");
											if(mysqli_num_rows($sqlnarration)>0){
												$valnarration = mysqli_fetch_array($sqlnarration);
												$narChallan = $valnarration['challan_no'];
												$amount = $valnarration['total_amount'] - $valnarration['paid_amount'];

												if($valnarration['due_date'] < date('Y-m-d')){
													$amount = $amount + LATEFEE;
												}

											}else{
												$narChallan = '';
												$amount = 0;
											}
											if($amount>0){
												echo'
												<tr>
													<td>'.$month['name'].' '.$year.'</td>
													<td style="text-align:center;">'.$narChallan.'</td>
													<td style="text-align:center;">'.$valnarration['due_date'].'</td>
													<td style="text-align:right;">'.number_format($amount).'</td>
												</tr>';
											}
										}
										$grandTotal = $grandTotal + $amount;
									endforeach;
									echo'
										<tr>
											<td colspan="3" style="text-align:right;"><b>Grand Total</b></td>
											<td style="text-align:right;">'.number_format($grandTotal).'</td>
										</tr>
									</tbody>
								</table>
							</div>';
						}

						echo'
						<div class="form-group">';
							if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
								// $col46 = "col-md-4";
								echo'
								<div class="col-md-4 mt-sm">
									<label class="control-label">Received Amount</label>
									<input type="text" id="totaltransamount" name="totaltransamount" class="form-control paid"/>
									<input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandTotal.'" class="form-control"/>
								</div>
								<div class="col-md-4 mt-sm">
									<label class="control-label">Receipt No</label>
									<input type="text" id="receipt_no" name="receipt_no" class="form-control"/>
								</div>
								<div class="col-md-4 mt-sm">
									<label class="control-label">Book No</label>
									<input type="text" id="book_no" name="book_no" class="form-control"/>
								</div>';
							}
							// else{ $col46 = "col-md-6"; }
							echo'
							<div class="col-md-6 mt-sm">
								<label class="control-label">Pay Mode </label>
								<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="pay_mode" name="pay_mode">
									<option value="">Select</option>';
									foreach($paymethod as $method){
										echo'<option value="'.$method['id'].'">'.$method['name'].'</option>';
									}
									echo '
								</select>
							</div>
							<div class="col-md-6 mt-sm">
								<label class="control-label">Paid Date </label>
								<input type="text" id="paid_date" name="paid_date" class="form-control" value="'.date('m/d/Y' , strtotime(date('Y-m-d'))).'" data-plugin-datepicker title="Must Be Required" />
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
						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label">Note </label>
								<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
							</div>
						</div>';
						if($valuesqllmscheck['challan_no'] != $rowsvalues['challan_no']){
							echo'
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
							';
						}
						echo'
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">';
							if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
								echo'<button type="submit" class="btn btn-primary" onClick=\'return confirmAddPayment()\' id="add_payment" name="add_payment">Add Payment</button>';
							}
							echo'
								<button type="submit" class="btn btn-primary" onClick=\'return confirmUpdate()\' id="changes_challan" name="changes_challan">Update</button>
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
	function confirmUpdate() {
		var agree=confirm("Are you sure you want to Update Challan?");
		if (agree)
		return true ;
		else
		return false ;
	}
	function confirmAddPayment() {
		var agree=confirm("Are you sure you want to Add Payment?");
		if (agree)
		return true ;
		else
		return false ;
	}
	$(document).on("keyup", ".remaining,.fine, .amount", function() {
		var sum = 0;
		$("input[class *= 'amount']").each(function(){
			sum += +$(this).val();
		});
		console.log(sum);
		$(".totalPayable").val(sum);
		var partialPaid = 	document.getElementById("partial_paid").value;
		$("#rem_amount").val(sum - partialPaid);
	});
</script>