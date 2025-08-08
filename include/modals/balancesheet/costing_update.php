<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '29', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT trans_id, trans_status, trans_title, trans_amount, voucher_no, trans_method, trans_note, dated, id_head
									FROM ".ACCOUNT_TRANS."
									WHERE trans_id = '".cleanvars($_GET['id'])."' AND trans_type = '2'
									AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="costing.php" class="form-horizontal" id="form" method="post" accept-charset="utf-8">
	<input type="hidden" name="trans_id" id="trans_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Expense Voucher</h2>
		</header>
		<div class="panel-body">

            <div class="form-group mt-sm">
                <label class="col-sm-3 control-label">Title <span class="required" aria-required="true">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="trans_title" value="'.$rowsvalues['trans_title'].'" autofocus="" required="" title="Must Be Required" aria-required="true">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Head <span class="required" aria-required="true">*</span></label>
                <div class="col-sm-9">
                    <select name="id_head" class="form-control select2-hidden-accessible" required="" data-plugin-selecttwo="" data-width="100%" data-minimum-results-for-search="Infinity" title="Must Be Required" aria-required="true" tabindex="-1" aria-hidden="true">
                        <option value="">Select Costing Head</option>';
                        //-----------------------------------------------------
                        $sqllmshead	= $dblms->querylms("SELECT head_id, head_name
                                                        FROM ".ACCOUNT_HEADS."
                                                        WHERE head_type = '2' AND head_status = '1' AND is_deleted != '1'
                                                        AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
                                                        ORDER BY head_name ASC");
                        //-----------------------------------------------------
                        while($value_head = mysqli_fetch_array($sqllmshead)) {
                        echo '<option value="'.$value_head['head_id'].'"'; if($value_head['head_id'] == $rowsvalues['id_head']){echo 'selected';} echo'>'.$value_head['head_name'].'</option>';
                        }
                    echo '
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Amount <span class="required" aria-required="true">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="trans_amount" value="'.$rowsvalues['trans_amount'].'" required="" title="Must Be Required" aria-required="true">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Method</label>
                <div class="col-sm-9">
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" value="1" id="trans_method" name="trans_method"'; if($rowsvalues['trans_method'] == 1){echo 'checked';} echo'>
                        <label for="trans_method">Cash</label>
                    </div>
                    <div class="radio-custom radio-primary radio-inline">
                        <input type="radio" value="2" id="trans_method" name="trans_method"'; if($rowsvalues['trans_method'] == 2){echo 'checked';} echo'>
                        <label for="trans_method">Check</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Voucher ID <span class="required" aria-required="true">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="voucher_no" value="'.$rowsvalues['voucher_no'].'" required="" title="Must Be Required" aria-required="true">
                </div>
            </div>

            <div class="form-group mb-md">
                <label class="col-sm-3 control-label"> Date <span class="required" aria-required="true">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" data-plugin-datepicker="" value="'.$rowsvalues['dated'].'" name="dated" required="" title="Must Be Required" aria-required="true">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Note</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="trans_note" value="'.$rowsvalues['trans_note'].'">
                </div>
            </div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_costing" name="changes_costing">Update</button>
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