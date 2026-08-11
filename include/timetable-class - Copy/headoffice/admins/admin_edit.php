<?php
//------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1)) { 
//------------------------------------------------
$sqllms	= $dblms->querylms("SELECT a.adm_id, a.adm_status, a.adm_type, a.adm_username, a.adm_fullname,
								a.adm_email, a.adm_phone, a.adm_photo, a.adm_photo
								FROM ".ADMINS." a  
								WHERE a.adm_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="admins.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="adm_id" id="adm_id" value="'.cleanvars($_GET['id']).'">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Edit Admin Detail</h4>
</div>
<div class="panel-body">
<label class="control-label">Photo</label>

<div class="row">
	<div class="col-md-6">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">';
		if($rowsvalues['adm_photo']) { 
			echo'<img src="uploads/images/admins/'.$rowsvalues['adm_photo'].'" class="rounded img-responsive">';
		} else {
			echo '<img src="uploads/defualt.png" class="rounded img-responsive">';
		}
		echo '
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
			<input type="text" class="form-control" name="adm_fullname" id="adm_fullname" value="'.$rowsvalues['adm_fullname'].'" required title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">User Name <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_username" id="adm_username" value="'.$rowsvalues['adm_username'].'" required title="Must Be Required" value="" >
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Email <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_email" id="adm_email"  value="'.$rowsvalues['adm_email'].'" required title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			<input type="text" class="form-control" name="adm_phone" id="adm_phone"  value="'.$rowsvalues['adm_phone'].'" required title="Must Be Required" value="" >
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Admin Type </label>
			<select name="adm_type" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate">
				<option value="'.$rowsvalues['adm_type'].'"></option>';
			foreach($admtypes as $itemadmtypes) {
				echo '<option value="'.$itemadmtypes['id'].'"'; if($itemadmtypes['id'] == $rowsvalues['adm_type']){echo ' selected';} echo '>'.$itemadmtypes['name'].'</option>';
			}
echo '			</select>
		</div>
	</div>
</div>
<div class="form-group mt-lg">
	<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
	<div class="col-md-9">
		<div class="radio-custom radio-inline">
			<input type="radio" id="status" name="adm_status" value="1"'; if($rowsvalues['adm_status'] == 1) {echo' checked';}echo'>
			<label for="radioExample1">Active</label>
		</div>

		<div class="radio-custom radio-inline">
			<input type="radio" id="status" name="adm_status" value="2"'; if($rowsvalues['adm_status'] == 2) {echo' checked';}echo'>
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
//------------------------------------------------
$kij++;
	echo '
	<div style="clear:both;"></div>
	<div class="col-lg-12 heading-modal mt-sm" style="background-color: #cb3f44; color: white; padding: 5px; border-radius: 5px;">
		<input id="role_'.$kij.'" type="checkbox" class="checkbox-inline"><b> '.$itemroletypes['name'].'</b>
	</div>
	<div style="clear:both;"></div>';
//------------------------------------------------
$rolesarray[] = ' $("#role_'.$kij.'").change(function () {
                $(".role_'.$kij.'").prop("checked", $(this).prop("checked"));
            });';
//------------------------------------------------
while($rowroles = mysqli_fetch_array($sqllmsroles)) {
$sri++;
$ji++;
$brolesarray[] = ' $("#roleb_'.$sri.'").change(function () {
                $(".roleb_'.$sri.'").prop("checked", $(this).prop("checked"));
            });';
//------------------------------------------------
	$sqllmsadmroles  = $dblms->querylms("SELECT right_name, added, updated, deleted, reporting, view, right_type, id_adm  
										FROM ".ADMIN_ROLES." 
										WHERE right_type = '".$itemroletypes['id']."' 
										AND right_name = '".$rowroles['role_id']."' 
										AND id_adm = '".$_GET['id']."' LIMIT 1");
//--------------------------------------------------
if(mysqli_num_rows($sqllmsadmroles) >0) {
//------------------------------------------------
	$rowsadmvalue = mysqli_fetch_assoc($sqllmsadmroles);
	if($rowsadmvalue['added'] == 1) 	{ $addchecked 	= ' checked="checked"'; } else { $addchecked 	= ''; }
	if($rowsadmvalue['updated'] == 1) 	{ $editchecked 	= ' checked="checked"'; } else { $editchecked 	= ''; }
	if($rowsadmvalue['deleted'] == 1) 	{ $deletchecked = ' checked="checked"'; } else { $deletchecked	= ''; }
	if($rowsadmvalue['view'] == 1) 		{ $viewchecked 	= ' checked="checked"'; } else { $viewchecked 	= ''; }
//------------------------------------------------
echo '
	<div class="col-sm-41">
		<div class="form_sep" style="margin-top:10px;">
		<div class="col-sm-3">
			<label><input id="roleb_'.$sri.'" type="checkbox" class="checkbox-inline role_'.$kij.'"> '.$rowroles['role_name'].'</label><br>
			<input id="added_'.$sri.'" name="added['.$sri.']" type="checkbox" value="1" '.$addchecked.' class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Add 
			<input id="updated_'.$sri.'" name="updated['.$sri.']" type="checkbox" value="1" '.$editchecked.' class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Edit
			<input id="deleted_'.$sri.'" name="deleted['.$sri.']" type="checkbox" value="1" '.$deletchecked.' class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Delete
			<input id="view_'.$sri.'"  name="view['.$sri.']" type="checkbox" value="1" '.$viewchecked.' class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> View
		</div>
		</div> 
	</div>';
//----------------------------
} else  { 
//----------------------------
echo '
	<div class="col-sm-41">
		<div class="form_sep" style="margin-top:10px;">
		<div class="col-sm-3">
			<label><input id="roleb_'.$sri.'" type="checkbox" class="checkbox-inline role_'.$kij.'"> '.$rowroles['role_name'].'</label><br>
			<input id="added_'.$sri.'" name="added['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.' "> Add 
			<input id="updated_'.$sri.'" name="updated['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Edit
			<input id="deleted_'.$sri.'" name="deleted['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> Delete
			<input id="view_'.$sri.'"  name="view['.$sri.']" type="checkbox" value="1" class="checkbox-inline role_'.$kij.' roleb_'.$sri.'"> View
		</div> 
		</div>
	</div>';
}
//----------------------------
echo'
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
			<button type="submit" id="changes_admin" name="changes_admin" class="mr-xs btn btn-primary">Update Admin</button>
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