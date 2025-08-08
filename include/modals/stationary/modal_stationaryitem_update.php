<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT i.item_id, i.item_status, i.id_cat, i.item_name, i.item_code, i.item_detail,
								  	   c.cat_name
								   FROM ".INVENTORY_ITEMS." i  
								   
								   INNER JOIN ".INVENTORY_CATEGORY." c ON c.cat_id = i.id_cat
								   WHERE i.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND  i.item_id =  '".cleanvars($_GET['id'])."'
								   ORDER BY i.item_name ASC");
	$rowsvalues = mysqli_fetch_array($sqllms);
//---------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '41', 'updated' => '1'))){ 
//---------------------------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="stationary-item.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="item_id" id="item_id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Item</h2>
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
						$sqllmscls	= $dblms->querylms("SELECT cat_id, cat_name 
													FROM ".INVENTORY_CATEGORY."
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
			<div class="form-group">
				<label class="col-md-3 control-label">Item Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input class="form-control" rows="3" id="item_code" name="item_code" value="'.$rowsvalues['item_code'].'"/>
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