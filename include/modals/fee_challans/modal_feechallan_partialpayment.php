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
								   st.std_id, st.std_name, st.std_regno
								   FROM ".FEES." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   INNER JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND f.id = '".cleanvars($_GET['id'])."'
								   ORDER BY f.challan_no DESC");
	$rowsvalues = mysqli_fetch_array($sqllms);
	//--------------------------------------

	// $concession = $rowsvalues['scholarship'] + $rowsvalues['concession'];
	//---------- Count Challans for Edit Balance --------------
	//if there is one challan then previous balnc editable
	$sqllms_blnc	= $dblms->querylms("SELECT  id
												FROM ".FEES."		
												WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
												AND id_std = '".cleanvars($rowsvalues['id_std'])."'
												AND is_deleted !=  '1'
												ORDER BY challan_no DESC");
	if(mysqli_num_rows($sqllms_blnc) > 1)
	{
		$blnc_edit = "readonly";
	}else{
		$blnc_edit = "";
	}
	//------------------------TUITION FEE------------------------
	$sql_tuitionfee	= $dblms->querylms("SELECT amount
									   FROM ".FEESETUPDETAIL." d
									   INNER JOIN ".FEESETUP." f ON f.id = d.id_setup
									   WHERE f.id_class = '".$rowsvalues['class_id']."' AND f.id_section = '".$rowsvalues['section_id']."'
									   AND   d.id_cat = '1'");
	//-----------------------------------------------------
	$values_tuitionfee = mysqli_fetch_array($sql_tuitionfee);
	$tuition_fee = $values_tuitionfee['amount'];
	//-----------------------------------------------------
	//-----------------------------------------------------
	$total_fee = $rowsvalues['total_amount'];
	//-----------------------------------------------------
echo '
<style>
	.mt--10{
		margin-top: -10px;
	}
</style>
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
		<input type="hidden" name="id_fee" id="id_fee" value="'.cleanvars($_GET['id']).'">
		<input type="hidden" name="challan_no" id="challan_no" value="'.cleanvars($rowsvalues['challan_no']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Partial Payment </h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-xs mt--10">
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
			<div class="form-group mt--10">
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
			</div>	';
			// echo'	
			// <div class="form-group mt-sm">
			// 	<div class="col-md-12">
			// 		<div class="row clearfix">';
			// 			//--------------------------------------
			// 			$total_fee = 0;
			// 				//------------------------------------------------
			// 				$sqllmscats  = $dblms->querylms("SELECT cat_id, cat_name  
			// 													FROM ".FEE_CATEGORY."
			// 													WHERE cat_status = '1' 
			// 													ORDER BY cat_id ASC");
			// 				$countcats = mysqli_num_rows($sqllmscats);
			// 				//--------------------------------------
			// 				if($countcats >0) {
			// 					$src = 0;
			// 					$scholarshipConcession = 0;
			// 					$fine = 0;
			// 					while($rowdoc 	= mysqli_fetch_array($sqllmscats)) {
			// 						//------------------------------------
			// 						$sqllmsfeeprt  = $dblms->querylms("SELECT id, id_cat, amount 
			// 																FROM ".FEE_PARTICULARS." 
			// 																WHERE id_cat = '".$rowdoc['cat_id']."' AND id_fee  = '".$rowsvalues['id']."' 
			// 																LIMIT 1");
			// 								if(mysqli_num_rows($sqllmsfeeprt) > 0 || $rowdoc['cat_id'] == 13) { 
			// 									$valuefeeprt = mysqli_fetch_array($sqllmsfeeprt);
			// 									if($rowdoc['cat_id'] == 17){
			// 										$scholarshipConcession = $valuefeeprt['amount'] * 2;
			// 									}else if($rowdoc['cat_id'] == 14){
			// 										$fine = $valuefeeprt['amount'];
			// 									}
			// 									echo'
			// 									<div class="col-md-4">
			// 										<div class="form-group mt-sm">
			// 											<div class="col-md-12">
			// 												<label class=control-label">'.$rowdoc['cat_name'].' <span class="required">*</span></label>
			// 												<input type="hidden" name="id[]" value="'.$valuefeeprt['id'].'">
			// 												<input type="hidden" name="id_cat[]" value="'.$rowdoc['cat_id'].'">
			// 												<input type="number" id="amount" name="amount[]" class="form-control cats" required title="Must Be Required" value="'.$valuefeeprt['amount'].'"'; if($rowdoc['cat_id'] != 13){echo'readonly';} echo' '.$blnc_edit.'/>
			// 											</div>
			// 										</div>
			// 									</div>';
			// 								}
			// 					}
			// 				}
			// 				echo'
			// 				<input type="hidden" name="total_fee" value="'.$total_fee.'">
			// 		</div>
			// 	</div>
			// </div>';
			$maxAllowedPartail = $rowsvalues['total_amount'] / 2;
			
			if(date('Y-m-d') > $rowsvalues['due_date']) {
				$granTotal = $rowsvalues['total_amount'] + 300;
			} else {
				$granTotal = $rowsvalues['total_amount'];
			}
			echo'
			<div class="form-group mt--10">
				<div class="col-md-6">
					<label class="control-label">Payable <span class="required">*</span></label>
					<input type="text" id="payable" name="payable" class="form-control total" required title="Must Be Required" value="'.$granTotal.'" readonly/>
				</div>
				<input type="hidden" name="prev_remaining_amount" value="'.$rowsvalues['remaining_amount'].'">
				<div class="col-md-6">
					<label class="control-label">Partial Amount <span class="required">*</span></label>
					<input type="number" id="partial_amount" name="partial_amount" placeholder="Must Greater than 50% of Payable" min="'.$maxAllowedPartail.'" max="'.$rowsvalues['total_amount'].'" class="form-control paid" required title="Must be greater than '.$maxAllowedPartail.' and less than '.$rowsvalues['total_amount'].'"/>
				</div>
			</div>
			<div class="form-group mt--10">
				<div class="col-md-12">
					<label class="control-label">Rem. Amount </label>
					<input type="text" id="remaining_amount" name="remaining_amount" class="form-control rem" readonly/>
				</div>
			</div> 
			<div class="form-group mt--10">
				<div class="col-md-12">
					<label class="control-label">Note </label>
					<textarea class="form-control" rows="2" name="note" id="note">'.$rowsvalues['note'].'</textarea>
				</div>
			</div>					
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_partialPayment" name="changes_partialPayment">Update</button>
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
	$(document).on("change", ".paid", function() {
		var payable =  document.getElementById("payable").value;
		var paid = document.getElementById("partial_amount").value;
		var rem  = payable - paid;
		$(".rem").val(rem);
	});
</script>