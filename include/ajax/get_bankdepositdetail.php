<?php 
//error_reporting(0);
//session_start();
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";

if(isset($_POST['idbank'])){
	//fcc.date = '".date('Y-m-d')."'
	
	$challandate = date('Y');

	if($_POST['idbank'] == 5) { 
		$dheading = "CASH Payment Voucher #";
		$required = " required";

	if($_POST['deptid'] == 1) {
		$deptcode = 'AGS';
	} else {
		$deptcode = 'TAH';
	}
		$sqllmsfee 	= $dblms->querylms("SELECT MAX(deposit_slip) as deposit_slip 
										FROM ".FEES_COLLECTION_BANK_DEPOSIT." 
										WHERE deposit_slip LIKE 'CP-".$deptcode."-".$challandate."%'  
										");
		$rowfeeid 	= mysqli_fetch_array($sqllmsfee);
		if($rowfeeid['deposit_slip'] != NULL) {
			$recepitno 	= $rowfeeid['deposit_slip'];
			$recepitno++;
			$yearlysrno = str_replace('CP-'.$deptcode.'-', '', $recepitno);
		} else  {
			$recepitno	= 'CP-'.$deptcode.'-'.$challandate.'00001';
			$yearlysrno	= $challandate.'00001';
		}

	} else {
		$dheading = "Deposit Slip #";
		$required = " ";

		$sqllmsfee 	= $dblms->querylms("SELECT MAX(deposit_slip) as deposit_slip 
										FROM ".FEES_COLLECTION_BANK_DEPOSIT." 
										WHERE deposit_slip LIKE 'BD-".$challandate."%'  
										");
		$rowfeeid 	= mysqli_fetch_array($sqllmsfee);
		if($rowfeeid['deposit_slip'] != NULL) {
			$recepitno 	= $rowfeeid['deposit_slip'];
			$recepitno++;
			$yearlysrno = str_replace('BD-', '', $recepitno);
		} else  {
			$recepitno	= 'BD-'.$challandate.'00001';
			$yearlysrno	= $challandate.'00001';
		}
	}
	

//------------------------------------------------------
    echo '
	<input type="hidden" name="yearlysrno" id="yearlysrno" value="'.$yearlysrno.'">
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<div class="form-group">
							<div class="col-md-12">
								<div class="row clearfix" style="margin-top:10px;">
									<div class="col-md-4">
										<label class="control-label">'.$dheading.' <span class="required">*</span></label>
										<input type="text" class="form-control" name="deposit_slip" id="deposit_slip" required title="Must Be Required" readonly value="'.$recepitno.'" />
									</div>';
								if($_POST['idbank'] == 5) { 
									echo '
									<div class="col-md-4" style="margin-bottom:10px;">
										<label class="control-label">Name of Payee <span class="required">*</span></label>
										<input type="text" class="form-control" name="payeee" id="payeee" required title="Must Be Required" value="" />
									</div>
									<div class="col-md-4" style="margin-bottom:10px;">
										<label class="control-label">Head of Expenses <span class="required">*</span></label>
										<input type="text" class="form-control" name="expense_head" id="expense_head" required title="Must Be Required" value="" />
									</div>';
								} else {
									echo '<input type="hidden" class="form-control" name="payeee" value="">
											<input type="hidden" class="form-control" name="expense_head" value="">';
								}
								echo '
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Total Amount <span class="required">*</span></label>
												<input type="number" class="form-control" name="amount" id="amount" min="1" max="'.(!empty($_POST['amountpaid']) ? $_POST['amountpaid'] : 1).'" required title="Must Be Required" value=""/>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<div class="col-md-12">
												<label class=control-label">Date <span class="required">*</span></label>
												<input type="text" id="date" name="date" class="form-control" data-plugin-datepicker required title="Must Be Required" value="'.date("m/d/Y").'" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

                <div style="clear: both;"></div>
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label">Remarks</label>
						<textarea class="form-control" rows="2" name="remarks" id="remarks" '.$required.'></textarea>
					</div>
				</div>
			</div>';
}
