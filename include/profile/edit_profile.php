<?php 
$sqllms	= $dblms->querylms("SELECT a.adm_id, a.adm_status, a.adm_type, a.adm_username, a.adm_fullname,
								   a.adm_email, a.adm_phone, a.adm_photo, a.id_campus,
								   c.campus_id, c.campus_status, campus_regno, campus_code, campus_name, 
								   c.campus_email, c.campus_address, campus_email, c.campus_phone

								FROM ".ADMINS." a  
								INNER JOIN ".CAMPUS." c ON c.campus_id = a.id_campus
								WHERE a.adm_id = '".$_SESSION['userlogininfo']['LOGINIDA']."'");
//-----------------------------------------------------
while($rowsvalues = mysqli_fetch_array($sqllms)) {
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="adm_id" value="'.$rowsvalues['adm_id'].'">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">';
						if($rowsvalues['adm_photo']) { 
    					echo'
							<img src="uploads/images/admins/'.$rowsvalues['adm_photo'].'" class="rounded img-responsive">' ;
    					} else {
				 			echo "No Image";
						}
   			 			echo'
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
					<div>
						<span class="mr-xs btn btn-xs btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="adm_photo" accept="image/*">
						</span>
						<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="adm_fullname" value="'.$rowsvalues['adm_fullname'].'">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Username <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="adm_username" value="'.$rowsvalues['adm_username'].'"  />
			</div>
		</div>	
		<div class="form-group">
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
					<input type="text" class="form-control" name="adm_phone" required value="'.$rowsvalues['adm_phone'].'" />
				</div>
			</div>
		</div>
		<div class="form-group mb-md">
			<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" name="adm_email" id="adm_email" value="'.$rowsvalues['adm_email'].'"/>
				</div>
			</div>
		</div>
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary" name="changes_profile">Update Profile</button>
			</div>
		</div>
	</div>
</form>
</div>';
}
?>