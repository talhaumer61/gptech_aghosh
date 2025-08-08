<?php 

//---------------------------------------------
include "../../dbsetting/lms_vars_config.php";
include "../../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../../functions/login_func.php";
include "../../functions/functions.php";
checkCpanelLMSALogin();
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '90', 'add' => '1'))){ 
	
if(isset($_GET['idchallan'])){
	//echo $_POST['challano'];
	$challano     =   $_GET['idchallan']; 
$today = date('m/d/Y');
// if(isset($_POST['id_month'])){
// 	$DueMonth = $_POST['id_month'];
// 	$DueDate = date(''.$DueMonth.'/15/Y');
// }else{
// 	$DueDate = date('m/15/Y');
// }
//---------------------------------------------
echo '
<!-- Add Modal Box -->
	<section class="panel panel-featured panel-featured-primary">
		<form action="feecollections.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Pay Fee Challan</h2>
			</header>
			<div class="panel-body">			
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label">Challan #<span class="required">*</span></label>
						<input type="text" class="form-control" name="challanno" id="challanno" value="'.$challano.'" maxlength="11" required title="Must Be Required" readyonly tabindex="1" />
					</div>
				</div>';
 

				// Query get data
	$sqllms	= $dblms->querylms("SELECT  f.id, f.status, f.id_type, f.id_month, f.challan_no, f.id_session, f.id_class, f.id_section, f.id_std,
								   f.issue_date, f.due_date, f.total_amount, f.paid_amount, f.scholarship, f.concession, f.fine, f.prev_remaining_amount, f.remaining_amount, f.note, 
								   f.inquiry_formno, q.name, q.fathername, c.class_id, c.class_name,c.id_classgroup, q.cell_no, 
								   cs.section_id, cs.section_name,
								   s.session_id, s.session_name,
								   st.std_id, st.std_name, st.std_regno, st.std_phone, st.std_whatsapp
								   FROM ".FEES." f				   
								   INNER JOIN ".CLASSES." c ON c.class_id = f.id_class	 	
								   LEFT JOIN ".CLASS_SECTIONS." cs ON cs.section_id = f.id_section							 
								   INNER JOIN ".SESSIONS." s ON s.session_id = f.id_session							 
								   LEFT JOIN ".STUDENTS." st ON st.std_id 	 = f.id_std 
								   LEFT JOIN ".ADMISSIONS_INQUIRY." q ON q.form_no = f.inquiry_formno
								   WHERE f.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND f.challan_no = '".cleanvars(trim($challano))."'
								   ORDER BY f.challan_no DESC");
	$rowsvalues = mysqli_fetch_array($sqllms);
	if($rowsvalues){
		if($rowsvalues['status'] == 1) {
			echo '<h2 style="text-align:center; font-weight:600; color:#00f;">Challan Already Paid</h2>';
		} else {
		if($rowsvalues['std_name']){ $stdName = $rowsvalues['std_name'];} else {$stdName = $rowsvalues['name'];}
		if($rowsvalues['std_fathername']){ $stdFather = $rowsvalues['std_fathername'];} else {$stdFather = $rowsvalues['fathername'];}

            if($rowsvalues['std_whatsapp']) {
                $mobilenum1 = '92'.str_replace('-', '', ltrim($rowsvalues['std_whatsapp'], '0'));
            } else  if($rowsvalues['cell_no']) {
                $mobilenum1 = '92'.str_replace('-', '', ltrim($rowsvalues['cell_no'], '0'));
            } else {
                $mobilenum1 = '';
            }
            if($mobilenum1 !='' &&  strlen($mobilenum1) == 12 ) {
                echo '<input type="hidden" name="whatsappno" id="whatsappno" value="'.$mobilenum1.'">';
            } else {
                echo '<input type="hidden" name="whatsappno" id="whatsappno" value="">';
            }
			if($rowsvalues['id_classgroup'] !=3) { $classgroup = "AGS"; } else { $classgroup = "TAH"; }
			echo '	
			<input type="hidden" name="std_phone" id="std_phone" value="'.$rowsvalues['std_whatsapp'].'">
			<input type="hidden" name="id_std" id="id_std" value="'.$rowsvalues['id_std'].'">
			<input type="hidden" name="id_month" id="id_month" value="'.$rowsvalues['id_month'].'">
			<input type="hidden" name="dueDate" id="dueDate" value="'.$rowsvalues['due_date'].'">
			<input type="hidden" name="id_type" id="id_type" value="'.$rowsvalues['id_type'].'">
			<input type="hidden" name="classgroup" id="classgroup" value="'.$classgroup.'">
			<input type="hidden" name="monthname" id="monthname" value="'.get_monthtypes($rowsvalues['id_month']).'">
					<div class="col-md-12">
						<div class="row clearfix">
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class=control-label">Student <span class="required">*</span></label>
										<input type="text" class="form-control" required title="Must Be Required" name="stdname" value="'.$stdName.'" tabindex="-1"  readonly/>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class=control-label">Class <span class="required">*</span></label>
										<input type="text" class="form-control" required title="Must Be Required" value="'.$rowsvalues['class_name'].'"'; if($rowsvalues['section_name']){echo'( '.$rowsvalues['section_name'].' )';} echo'" readonly/>
									</div>
								</div>
							</div>

						</div>
					</div>
				
				<div class="form-group">
					<div class="col-md-12">
						<div class="row clearfix" style="margin-top:10px;">
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
										<input type="text" id="due_date" name="due_date" class="form-control" data-plugin-datepicker required title="Must Be Required" value="'.date('m/d/Y' , strtotime(cleanvars($rowsvalues['due_date']))).'" readonly />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
			$grandTotal = 0;
			if($rowsvalues['id_type'] == 1) { 
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
							$narChallan = $rowsvalues['challan_no'];
								$amount = ($rowsvalues['total_amount'] - $rowsvalues['paid_amount']);

								if($rowsvalues['due_date'] < date('Y-m-d')){
									$amount = $amount + LATEFEE;
								}

								echo'
								<tr>
									<td>'.get_monthtypes($rowsvalues['id_month']).'</td>
									<td style="text-align:center;">'.$narChallan.'</td>
									<td style="text-align:center;">'.$rowsvalues['due_date'].'</td>
									<td style="text-align:right;">'.number_format($amount).'</td>
								</tr>
								<input type="hidden" name="id_fee[]" id="id_fee[]" value="'.cleanvars($rowsvalues['id']).'">
								<input type="hidden" name="amount[]" id="amount[]" value="'.cleanvars($amount).'">
								<input type="hidden" name="challan_no[]" id="challan_no[]" value="'.$narChallan.'">';
								$grandTotal = ($grandTotal + $amount);
								echo '
							<tr>
								<td colspan="3" style="text-align:right;"><b>Grand Total</b></td>
								<td style="text-align:right;">'.number_format($grandTotal).'</td>
							</tr>
						</tbody>
					</table>
				</div>';
			} else {

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
							
							foreach ($monthtypes as $month):
								// CURRENT MONTH
								if($rowsvalues['id_month']==$month['id']){
									$narChallan = $rowsvalues['challan_no'];
									$amount = ($rowsvalues['total_amount'] - $rowsvalues['paid_amount']);

									if($rowsvalues['due_date'] < date('Y-m-d')){
										$amount = $amount + LATEFEE;
									}

									echo'
									<tr>
										<td>'.$month['name'].' '.$year.'</td>
										<td style="text-align:center;">'.$narChallan.'</td>
										<td style="text-align:center;">'.$rowsvalues['due_date'].'</td>
										<td style="text-align:right;">'.number_format($amount).'</td>
									</tr>
									<input type="hidden" name="id_fee[]" id="id_fee[]" value="'.cleanvars($rowsvalues['id']).'">
									<input type="hidden" name="amount[]" id="amount[]" value="'.cleanvars($amount).'">
									<input type="hidden" name="challan_no[]" id="challan_no[]" value="'.$narChallan.'">';
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
										</tr>
										<input type="hidden" name="id_fee[]" id="id_fee[]" value="'.cleanvars($valnarration['id']).'">
										<input type="hidden" name="amount[]" id="amount[]" value="'.cleanvars($amount).'">
										<input type="hidden" name="challan_no[]" id="challan_no[]" value="'.$narChallan.'">';
									}
								}
								$grandTotal = ($grandTotal + $amount);
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
			}

			echo'
			<div class="form-group">';
				//if($valuesqllmscheck['challan_no'] == $rowsvalues['challan_no']){
					// $col46 = "col-md-4";
					echo'
					<div class="col-md-4 mt-sm">
						<label class="control-label">Received Amount <span class="required">*</span></label>
						<input type="number" id="totaltransamount" name="totaltransamount" min="'.$grandTotal.'" max="'.$grandTotal.'" class="form-control paid" tabindex="2" value="'.$grandTotal.'" required/>
						<input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandTotal.'" class="form-control"/>
					</div>
					<!--div class="col-md-4 mt-sm">
						<label class="control-label">Receipt No <span class="required">*</span></label>
						<input type="text" id="receipt_no" name="receipt_no" class="form-control"/>
					</div>
					<div class="col-md-4 mt-sm">
						<label class="control-label">Book No <span class="required">*</span></label>
						<input type="text" id="book_no" name="book_no" class="form-control"/>
					</div-->';
			//	}
				// else{ $col46 = "col-md-6"; }
				echo'
				<div class="col-md-4 mt-sm">
					<label class="control-label">Pay Mode <span class="required">*</span></label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="pay_mode" name="pay_mode">
						<option value="1">Cash</option>
					</select>
				</div>
				<div class="col-md-4 mt-sm">
					<label class="control-label">Paid Date <span class="required">*</span></label>
					<input type="text" id="paid_date" name="paid_date" class="form-control" value="'.date('m/d/Y' , strtotime(date('Y-m-d'))).'" data-plugin-datepicker title="Must Be required" />
				</div>
			</div>
			
			<div style="clear: both;"></div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Note</label>
					<textarea class="form-control" rows="2" name="note" id="note"></textarea>
				</div>
			</div>';
		}
	}else{
		echo '<h2 style="text-align:center; font-weight:600; color:#00f;">Invalid Challan</h2>';
	}

      echo '          
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						
						<button type="submit" class="btn btn-primary" id="challan_cashpay"  name="challan_cashpay"  onClick=\'return confirmSubmitmodel()\'>Paid</button>
						<button class="btn btn-default modal-dismiss" data-dismiss="modal">Cancel </button>
					</div>
				</div>
			</footer>
		</form>
	</section>';
}

}