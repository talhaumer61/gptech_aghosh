<?php
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1)|| ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '73', 'added' => '1'))){
echo'
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="students.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Student</h4>
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
					<input type="file" name="std_photo" accept="image/*">
				</span>
				<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Firstname <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_firstname" id="std_firstname" title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Lastname <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_lastname" id="std_lastname" title="Must Be Required" value="" >
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Gender </label>
			<select name="std_gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate">
				<option value="">Select</option>
				<option value="male" >Male</option>
				<option value="female" >Female</option>
			</select>
		</div>
		</div>	 
	<div class="col-md-6">
		<div class="form-group">
						<label class="control-label">Guardian <span class="required">*</span></label>
						<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_guardian">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT guardian_id, guardian_name
													FROM ".GUARDIANS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY guardian_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['guardian_id'].'">'.$valuecls['guardian_name'].'</option>';
							}
						echo '
						</select>
	</div>
</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Birthday </label>
			<input type="text" class="form-control" name="std_dob" id="std_dob" value="" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\'>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Blood Group </label>
			<select name="std_bloodgroup" id="std_bloodgroup" class="form-control populate" data-plugin-selectTwodata-width="100%" data-minimum-results-for-search="Infinity" >
				<option value="" selected="selected">Select</option>
				<option value="A+">A+</option>
				<option value="A-">A-</option>
				<option value="B+">B+</option>
				<option value="B-">B-</option>
				<option value="O+">O+</option>
				<option value="O-">O-</option>
				<option value="AB+">AB+</option>
				<option value="AB-">AB-</option>
			</select>
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Country <span class="required">*</span></label>
			<input type="text" class="form-control" name="id_country" id="id_country"  title="Must Be Required" value="" >
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">City <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_city" id="std_city"  title="Must Be Required" value="" >
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Nic <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_nic" id="std_nic" title="Must Be Required" value="">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_phone" id="std_phone" title="Must Be Required" value="">
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Address <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_address" id="std_address" title="Must Be Required" value="">
		</div>
    </div>
<div class="row mt-sm">		 
	<div class="col-md-6">
						<label class="control-label">Class <span class="required">*</span></label>
						<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY class_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
							}
						echo '
						</select>
	</div>
</div>
</div>
<div class="row mt-sm">
    <div class="col-sm-6">
     <div class="form-group">
			<label class="control-label">Section <span class="required"</span></label>
			<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
													FROM ".CLASS_SECTIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY section_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
							}
						echo '
						</select>
		</div>
	</div>
   <div class="col-sm-6">
     <div class="form-group">
			<label class="control-label">Group <span class="required">*</span></label>
			<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_group">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT group_id, group_name 
													FROM ".GROUPS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY group_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['group_id'].'">'.$valuecls['group_name'].'</option>';
							}
						echo '
						</select>
		</div>
	</div>
</div>
<div class="row mt-sm">
    <div class="col-sm-6">
        <div class="form-group">
			<label class="control-label">Session <span class="required">*</span></label>
			<select class="form-control" title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
													FROM ".SESSIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY session_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
						echo '
						</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Rollno </label>
			<input type="text" class="form-control" name="std_rollno" id="std_rollno" value="">
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Reg. No <span class="required">*</span></label>
			<input type="text" class="form-control" name="std_regno" id="std_regno" title="Must Be Required"></textarea>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Admission Date </label>
			<input type="text" class="form-control" name="std_admissiondate" id="std_admissiondate" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\'>
		</div>
	</div>
</div>
<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Login Id <span class="required">*</span></label>
			<input type="text" class="form-control" name="id_loginid" id="id_loginid" title="Must Be Required" value="">
		</div>
	</div>
</div>
<div class="form-group mt-sm">
	<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
	<div class="col-md-9">
		<div class="radio-custom radio-inline">
			<input type="radio" id="std_status" name="std_status" value="1" checked>
			<label for="radioExample1">Active</label>
		</div>
		<div class="radio-custom radio-inline">
			<input type="radio" id="std_status" name="std_status" value="2">
			<label for="radioExample2">Inactive</label>
		</div>
	</div>
</div>
<footer class="panel-footer mt-sm">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" id="submit_student" name="submit_student" class="mr-xs btn btn-primary">Add Student</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</footer>
</form>
</section>
</div>
</div>';
}
else{
	header("Location: dashboard.php");
}
?>