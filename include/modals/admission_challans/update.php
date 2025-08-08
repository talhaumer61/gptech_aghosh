<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '71', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  f.id, f.status, f.id_month, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std, f.inquiry_formno,
								   f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
								   c.class_id, c.class_name,
								   cs.section_id, cs.section_name,
								   s.session_id, s.session_name,
								   st.std_id, st.std_name, st.std_regno, st.std_phone,
								   q.name, q.cell_no
								   FROM ".FEES." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   LEFT JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
								   LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND f.id = '".cleanvars($_GET['id'])."'
								   AND f.id_type = '1'
								   ORDER BY f.challan_no DESC");
	$rowsvalues = mysqli_fetch_array($sqllms);

	//Std Name
	if($rowsvalues['std_name']){ $stdName = $rowsvalues['std_name'];} else {$stdName = $rowsvalues['name'];}

	// $total_fee = $rowsvalues['total_amount'];
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
		<input type="hidden" name="std_id" id="std_id" value="'.$rowsvalues['id_std'].'">
		<input type="hidden" name="std_phone" id="std_phone" value="'.$rowsvalues['cell_no'].'">
		<input type="hidden" name="form_no" id="form_no" value="'.$rowsvalues['inquiry_formno'].'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fee Challan </h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<div class="col-md-12">
					<div class="row clearfix">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-12">
									<label class=control-label">Student <span class="required">*</span></label>
									<input type="text" class="form-control" required title="Must Be Required" value="'.$stdName.'" readonly/>
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
							<div class="form-group">
								<div class="col-md-12">
									<label class="control-label">Month <span class="required">*</span></label>
									<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_month" name="id_month" required>
										<option value="">Select</option>';
										foreach($monthtypes as $month){
											echo'<option value="'.$month['id'].'" '.($month['id'] == $rowsvalues['id_month'] ? 'selected' : '').'>'.$month['name'].'</option>';
										}
										echo '
									</select>
								</div>
							</div>
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
						$sqllmscats  = $dblms->querylms("SELECT cat_id, cat_name  
															FROM ".FEE_CATEGORY."
															WHERE cat_status = '1' 
															ORDER BY cat_id ASC");
						$countcats 	= mysqli_num_rows($sqllmscats);

						if($countcats >0) {
							$src = 0;
							while($rowdoc 	= mysqli_fetch_array($sqllmscats)) {

								$sqllmsfeeprt  = $dblms->querylms("SELECT id, id_cat, amount 
																		FROM ".FEE_PARTICULARS." 
																		WHERE id_cat = '".$rowdoc['cat_id']."' AND id_fee  = '".$rowsvalues['id']."' 
																		LIMIT 1");
								if(mysqli_num_rows($sqllmsfeeprt)>0) { 
									$valuefeeprt = mysqli_fetch_array($sqllmsfeeprt);
									$src++;
									echo'
									<div class="col-md-4">
										<div class="form-group mt-sm">
											<div class="col-md-12">
												<label class=control-label">'.$rowdoc['cat_name'].' <span class="required">*</span></label>
												<input type="hidden" name="id[]" value="'.$valuefeeprt['id'].'">
												<input type="number" id="amount" name="amount[]" class="form-control cats" required title="Must Be Required" value="'.$valuefeeprt['amount'].'"/>
											</div>
										</div>
									</div>
									';
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
					$col = "col-md-3";
					echo'
					<div class="'.$col.'">
						<label class="control-label">Partial Paid </label>
						<input type="text" id="partial_paid" name="partial_paid" value="'.$onlinePaid['total_paid'].'" class="form-control" readonly/>
					</div>';
					$onlineTotalPaid = $onlinePaid['total_paid'];
				}else{
					$col = "col-md-4";
				}
				//---------------------------------
				$totalAmount = $rowsvalues['total_amount'] - $onlineTotalPaid;
				//---------------------------------
				echo'
				<div class="'.$col.'">
					<label class="control-label">Payable <span class="required">*</span></label>
					<input type="hidden" id="payable" name="total_amount" class="total totalPayable"  required title="Must Be Required" value="'.$totalAmount.'" readonly/>
					<input type="text" id="" name="payable" class="form-control total totalPayable" required title="Must Be Required" value="'.$granTotal.'" readonly/>
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
				<div class="'.$col.'">
					<label class="control-label">Paid Date </label>
					<input type="text" id="paid_date" name="paid_date" class="form-control" value="'.date('m/d/Y' , strtotime(date('Y-m-d'))).'" data-plugin-datepicker title="Must Be Required" />
				</div>
			</div>

			
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
					if($rowsvalues['status'] != 1) {echo' 
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
					<button type="submit" class="btn btn-primary" id="changes_admission_challan" name="changes_admission_challan">Update</button>
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
	$(document).on("change", ".cats", function() {
		var sum = 0;
		$(".cats").each(function(){
			sum += +$(this).val();
		});

		$(".total").val(sum);
	});
</script>