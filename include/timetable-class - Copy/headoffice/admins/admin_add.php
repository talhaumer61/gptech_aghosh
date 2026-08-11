<?php
//--------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1)) { 
//------------------------------------------------
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="admins.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Admin</h4>
</div>
<div class="panel-body">
<label class="control-label">Photo</label>
<div class="row">
	<div class="col-md-6">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">
				<img src="uploads/default-student.jpg" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 130px">
				
			</div>
			<div>
				<span class="btn btn-xs btn-default btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Change</span>
					<input type="file" name="adm_photo" accept="image/*">
				</span>
				<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Full Name <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_fullname" id="adm_fullname" required title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">User Name <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_username" id="adm_username" required title="Must Be Required" value="" >
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Email <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_email" id="adm_email" required title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_phone" id="adm_phone" required title="Must Be Required" value="" >
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Admin Type <span class="required">*</span></label>
			<select name="adm_type" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required" >
				<option value="">Select Type</option>';
			foreach($admtypes as $itemadmtypes) {
				echo '<option value="'.$itemadmtypes['id'].'">'.$itemadmtypes['name'].'</option>';
			}
echo '			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Password <span class="required">*</span></label>
			<input type="password" class="form-control" name="adm_userpass" id="adm_userpass" required title="Must Be Required" value="" >
		</div>
	</div>
</div>
<div class="form-group mt-lg">
	<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
	<div class="col-md-9">
		<div class="radio-custom radio-inline">
			<input type="radio" id="adm_status" name="adm_status" value="1" checked>
			<label for="radioExample1">Active</label>
		</div>
		<div class="radio-custom radio-inline">
			<input type="radio" id="adm_status" name="adm_status" value="2">
			<label for="radioExample2">Inactive</label>
		</div>
	</div>
</div>
	<div style="clear:both;"></div>
<div id="checkboxes">';

$sri = 0;
$ji = 0;
$kij = 0;
$rolesarray = array();
$brolesarray = array();
// for looop

	
foreach($roletypes as $itemroletypes) {
//------------------------------------------------
	$sqllmsroles  = $dblms->querylms("SELECT role_id, role_status, role_name, role_type 
										FROM ".ROLES." 
										WHERE role_type = '".$itemroletypes['id']."' 
										AND role_status = '1' 
										ORDER BY role_name ASC");
	//--------------------------------------------------
if (mysqli_num_rows($sqllmsroles) > 0) {
$kij++;
//------------------------------------------------
	echo '
	<div style="clear:both;"></div>
	<div class="col-lg-12 heading-modal mt-sm" style="background-color: #cb3f44; color: white; padding: 5px; border-radius: 5px;">
		<input id="role_'.$kij.'" type="checkbox" class="checkbox-inline"><b> '.$itemroletypes['name'].'</b>
	</div>
	<div style="clear:both;"></div>';
$rolesarray[] = ' $("#role_'.$kij.'").change(function () {
                $(".role_'.$kij.'").prop("checked", $(this).prop("checked"));
            });';
//------------------------------------------------
while($rowroles = mysqli_fetch_array($sqllmsroles)) {
$sri++;
$ji++;
//------------------------------------------------
echo '
	<div class="col-sm-41">
		<div class="form_sep" style="margin-top:10px;">
			<div class="col-sm-3" style="padding:10px;">
					<label><input id="roleb_'.$sri.'" type="checkbox" class="checkbox-inline role_'.$kij.'"><b style="color: #cb3f44"> '.$rowroles['role_name'].'</b></label><br>
					<input id="add_'.$sri.'" name="added['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Add 
					<input id="edit_'.$sri.'" name="updated['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Edit
					<input id="delete_'.$sri.'" name="deleted['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Delete
					<input id="view_'.$sri.'"  name="view['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> View
			</div>
		</div> 
	</div>
	<input type="hidden" name="right_name['.$sri.']" id="right_name['.$sri.']" value="'.$rowroles['role_id'].'">
	<input type="hidden" name="right_type['.$sri.']" id="right_type['.$sri.']" value="'.$itemroletypes['id'].'">';
//----------------------------
$brolesarray[] = ' $("#roleb_'.$sri.'").change(function () {
                $(".roleb_'.$sri.'").prop("checked", $(this).prop("checked"));
            });';
}  // end while loop
//echo '<input type="hidden" name="right_type['.$sri.']" id="right_type['.$sri.']" value="'.$itemroletypes['id'].'"> ';
//----------------------------
} // end if count
} // end foreach


//----------------------------
echo '
</div>
</div>
<footer class="panel-footer mt-sm">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" id="submit_admin" name="submit_admin" class="mr-xs btn btn-primary">Add Admin</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</footer>
</form>
</section>
</div>
</div>
<!--WI_ADD_NEW_TASK_MODAL-->
<script type="text/javascript">
          $(document).ready(function(){ ';
foreach($rolesarray as $totalrole) { 
	echo $totalrole;
}
foreach($brolesarray as $totalbrole) { 
	echo $totalbrole;
}
          
echo '
          });
</script>';
} 
else{
	header("Location: dashboard.php");
}
?>