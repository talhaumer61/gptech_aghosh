<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '34', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT item_id, item_status, id_cat, item_name, item_code, school_price, std_price, item_detail
								   FROM ".INVENTORY_ITEMS."
								   WHERE item_id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="stationary_item.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="item_id" id="item_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Stationary Item</h2>
		</header>
		<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Item Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="item_name" id="item_name" required title="Must Be Required" value="'.$rowsvalues['item_name'].'" />
				</div>
			</div>
			<div class="form-group">
					<label class="col-md-3 control-label">Category <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat">
						<option value="">Select</option>';
						$sqllms	= $dblms->querylms("SELECT cat_id, cat_name 
													FROM ".INVENTORY_CATEGORY."
													WHERE cat_status = '1' ORDER BY cat_name ASC");
					while($valueitem = mysqli_fetch_array($sqllms)) {
						if($valueitem['cat_id'] == $rowsvalues['id_cat']) { 
							echo '<option value="'.$valueitem['cat_id'].'" selected>'.$valueitem['cat_name'].'</option>';
						} else { 
							echo '<option value="'.$valueitem['cat_id'].'">'.$valueitem['cat_name'].'</option>';
						}
					}
			echo '
						</select>
					</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Item Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input class="form-control" rows="3" id="item_code" name="item_code" value="'.$rowsvalues['item_code'].'"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">School Price <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" rows="3" name="school_price" id="school_price" value="'.$rowsvalues['school_price'].'"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Student Price <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="number" class="form-control" rows="3" name= "std_price" id="std_price" value="'.$rowsvalues['std_price'].'"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Item Detail <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea class="form-control" rows="3" id="item_detail" name="item_detail">'.$rowsvalues['item_detail'].'</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">';
					if($rowsvalues['item_status'] == 1) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="item_status" name="item_status" value="1" checked>
								<label for="radioExample1">Active</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="item_status" name="item_status" value="1">
								<label for="radioExample1">Active</label>
							</div>';
					}
					if($rowsvalues['item_status'] == 2) { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="item_status" name="item_status" checked value="2">
								<label for="radioExample2">Inactive</label>
							</div>';
					} else { 
						echo '
							<div class="radio-custom radio-inline">
								<input type="radio" id="item_status" name="item_status" value="2">
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
					<button type="submit" class="btn btn-primary" id="changes_item" name="changes_item">Update</button>
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