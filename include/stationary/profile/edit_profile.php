<?php 
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.supplier_id, s.supplier_status, s.supplier_name, s.supplier_phone, s.supplier_email,
								   s.supplier_address, s.supplier_company, s.supplier_contactname, s.supplier_contactphone,
								   s.supplier_contactemail
								   FROM ".INVENTORY_SUPPLIERS." s 
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								   AND s.supplier_id = '".$_GET['id']."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
						<img src="uploads/admin_image/1.jpg" alt="...">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
					<div>
						<span class="mr-xs btn btn-xs btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="userfile" accept="image/*">
						</span>
						<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="supplier_name" id="supplier_name" value="'.$rowsvalues['supplier_name'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="supplier_phone" id="supplier_phone" value="'.$rowsvalues['supplier_phone'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="supplier_email" id="supplier_email" value="'.$rowsvalues['supplier_email'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Address <span class="required">*</span></label>
			<div class="col-md-8">
				<textarea class="form-control" name="supplier_address" id="supplier_address" >'.$rowsvalues['supplier_address'].'</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Company <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="supplier_company" id="supplier_company" value="'.$rowsvalues['supplier_company'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"Contact >Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="supplier_contactname" id="supplier_contactname" value="'.$rowsvalues['supplier_contactname'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Contact Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="supplier_contactphone" id="supplier_contactphone" value="'.$rowsvalues['supplier_contactphone'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Contact Email <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="supplier_contactemail" id="supplier_contactemail" value="'.$rowsvalues['supplier_contactemail'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
			<div class="col-md-9">';
				if($rowsvalues['supplier_status'] == 1) { 
				echo '
				<div class="radio-custom radio-inline">
					<input type="radio" id="supplier_status" name="supplier_status" value="1" checked>
					<label for="radioExample1">Active</label>
				</div>';
				} else { 
				echo '
				<div class="radio-custom radio-inline">
					<input type="radio" id="supplier_status" name="supplier_status" value="1">
					<label for="radioExample1">Active</label>
				</div>';
				}
				if($rowsvalues['supplier_status'] == 2) { 
				echo '
				<div class="radio-custom radio-inline">
					<input type="radio" id="supplier_status" name="supplier_status" checked value="2">
					<label for="radioExample2">Inactive</label>
				</div>';
				} else { 
				echo '
				<div class="radio-custom radio-inline">
					<input type="radio" id="supplier_status" name="supplier_status" value="2">
					<label for="radioExample2">Inactive</label>
				</div>';
				}
				echo '		
			</div>
		</div>
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" id="change_supplier" name="change_supplier" class="btn btn-primary">Update Profile</button>
			</div>
		</div>
	</div>
</form>
</div>';