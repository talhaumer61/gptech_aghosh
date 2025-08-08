<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '91', 'add' => '1'))){ 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	echo '
	<script src="assets/javascripts/user_config/forms_validation.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>
	<!-- Add Modal Box -->
	<div id="make_bankdeposit" class="zoom-anim-dialog modal-block modal-block-lg modal-block-primary mfp-hide">
		<section class="panel panel-featured panel-featured-primary">
			<form action="feecollections.php" class="form-horizontal" id="formdeposit" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
				<header class="panel-heading">
					<h2 class="panel-title"><i class="fa fa-plus-square"></i> Add Bank Deposit Details</h2>
				</header>
				<div class="panel-body">			
					<div class="form-group mt-sm">
						<div class="col-md-6">
							<label class="control-label">Department <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" onchange="get_accountdetails(this.value)" required name="id_dept" id="id_dept" >
								<option value="">Select</option>';
								foreach(get_department() as $key => $val){
									echo'<option value="'.$key.'">'.$val.'</option>';
								}
								echo '
							</select>
						</div>
						<div class="col-md-6">
							<label class="control-label">Balance <span class="required">*</span></label>
							<input type="text" class="form-control" readonly name="balancestring" id="balancestring" required title="Must Be Required" value="" />
							<input type="hidden" class="form-control" readonly name="balance" id="balance" required title="Must Be Required" value="" />
						</div>	
					</div>
					<div class="form-group mt-sm">
						<div class="col-md-12">
							<label class="control-label">Bank <span class="required">*</span></label>
							<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required name="id_bank" id="id_bank" onchange="get_bankdepositdetail(this.value)">
								<option value="">Select</option>';
								foreach($depositBankAccounts as $listbank){
									echo'<option value="'.$listbank['id_bank'].'">'.$listbank['bank_code'].' ('.$listbank['bank_account_no'].')</option>';
								}
								echo '
							</select>
						</div>
					</div>
						
					<div id="getbankdepositdetail">
					<div class="form-group">
								<div class="col-md-12">
									<div class="row clearfix" style="margin-top:10px;">
										<div class="col-md-4">
											<label class="control-label">Deposit Slip # <span class="required">*</span></label>
											<input type="text" class="form-control" name="deposit_slip" id="deposit_slip" required title="Must Be Required" value="" />
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="col-md-12">
													<label class=control-label">Total Amount <span class="required">*</span></label>
													<input type="number" class="form-control" name="amount" id="amount" min="1" max="1" required title="Must Be Required" value=""/>
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
							<textarea class="form-control" rows="2" name="remarks" id="remarks"></textarea>
						</div>
					</div>
				</div>
					
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary" id="submit_bank_deposit" name="submit_bank_deposit"  onClick=\'return confirmSubmit()\'>Add Bank Deposit</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>
	<script type="text/javascript">

		function get_bankdepositdetail(idbank) { 
			
			$("#loading").html(\'<img src="images/ajax-loader-horizintal.gif"> loading...\');  
			var amountpaid  = $("#balance").val(); 
			var deptid 		= $("#id_dept").val(); 
			console.log(amountpaid);
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_bankdepositdetail.php",
				data: "idbank="+idbank+"&amountpaid="+amountpaid+"&deptid="+deptid,  
				success: function(msg){  
					$("#getbankdepositdetail").html(msg); 
					$("#loading").html(\'\'); 
				}
			});  
		}

		function get_accountdetails(iddept) { 

			$("#loading").html(\'<img src="images/ajax-loader-horizintal.gif"> loading...\');  
			$.ajax({  
				type: "POST",  
				url: "include/ajax/get_accountdetails.php",
				data: {iddept :iddept},  
				success: function(msg){  
					data = JSON.parse(msg);
					$("#balance").val(data.balancenumber); 
					$("#balancestring").val(data.balancestring); 
					$("#loading").html(\'\'); 
				}
			});  
		}

	</script>
	<script LANGUAGE="JavaScript">
	<!--
	function confirmSubmit() {
		var agree=confirm("Are you sure you wish to continue?");
		if (agree)
		return true ;
		else
		return false ;
		}
	// -->
	</script>';
}
