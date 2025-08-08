<?php 
//---------------------------------------------------------
	include "../../../dbsetting/lms_vars_config.php";
	include "../../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../../functions/login_func.php";
	include "../../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '36', 'updated' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT   e.id, e.status, e.id_cat, e.name, e.voucher_no, e.dated, e.amount,  e.detail, e.id_added, e.id_modify, e.date_added, e.date_modify
								   		FROM ".EXPENSES." e 
										WHERE e.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
										AND e.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="expenses.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Edit Expense</h2>
		</header>
			<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Category Name<span class="required">*</span></label>
				<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_name 
													FROM ".EXPENSESCATEGORY."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY cat_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  if($valuecls['cat_id'] == $rowsvalues['id_cat']) { 
							  echo '<option value="'.$valuecls['cat_id'].'" selected>'.$valuecls['cat_name'].'</option>';
						  } else { 
							  echo '<option value="'.$valuecls['cat_id'].'">'.$valuecls['cat_name'].'</option>';
						  }
					  }
						echo '
						</select>
					</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Name<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" id="name" required title="Must Be Required" value="'.$rowsvalues['name'].'" />
				</div>
			</div>
				<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Voucher No<span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="voucher_no" id="voucher_no" required title="Must Be Required" value="'.$rowsvalues['voucher_no'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Dated <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="dated" id="dated" data-plugin-datepicker  required title="Must Be Required" value="'.$rowsvalues['dated'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="amount" id="amount" required title="Must Be Required" value="'.$rowsvalues['amount'].'" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Detail<span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="detail" id="detail" required title="Must Be Required">'.$rowsvalues['detail'].'</textarea>
				</div>
			</div>
	
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="status" name="status" value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					}
			echo '
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_expense" name="changes_expense">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}?>