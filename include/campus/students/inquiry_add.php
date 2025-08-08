<?php
	if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '1', 'add' => '1'))){
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT id, form_no, status, name, fathername, gender, cell_no, address, id_class, note
								FROM ".ADMISSIONS_INQUIRY." 
                                WHERE id != '' AND status = '1' AND id = '".$_GET['inquiry']."' LIMIT 1");
$srno = 0;
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------


//-------- Roll No -----------------
$newRollno = 0;
$sqllmsRoll	= $dblms->querylms("SELECT MAX(std_rollno) as rollno
								FROM ".STUDENTS."
								WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
								AND id_class = '".$rowsvalues['id_class']."'");
if(mysqli_num_rows($sqllmsRoll) > 0 ){
	$valueRoll = mysqli_fetch_array($sqllmsRoll);
	(int)$valueRoll['rollno'];
	$newRollno = (int)$valueRoll['rollno'] + 1;
}
else{
	$newRollno = 1;
}
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="students.php" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
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
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Form Number </label>
			<input type="text" class="form-control" name="form_no" value="'.$rowsvalues['form_no'].'" id="form_no" title="Must Be Required" autofocus onchange="get_formno(this.value)">
		</div>
	</div>
</div>

<div id="getadmissiondetail">
	<div class="row mt-sm">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Student Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_name" id="std_name"  value="'.$rowsvalues['name'].'"  required title="Must Be Required" autofocus>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Father Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_fathername" id="std_fathername" value="'.$rowsvalues['fathername'].'" required title="Must Be Required" >
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Gender <span class="required">*</span></label>
				<select name="std_gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
					<option value="">Select</option>
					<option value="Male"'; if($rowsvalues['gender'] == 'Male'){echo'selected';} echo'>Male</option>
					<option value="Female"'; if($rowsvalues['gender'] == 'Female'){echo'selected';} echo'>Female</option>
				</select>
			</div>
		</div>	
	</div>

	<div class="row mt-sm">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">NIC / B-Form</label>
				<input type="text" class="form-control" name="std_nic" id="std_nic"">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Guardian</label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_guardian">
					<option value="">Select</option>';
				foreach($guardian as $value){
				echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}
				echo '
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Is Orphan <span class="required">*</span></label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_orphan" required title="Must Be Required">
					<option value="">Select</option>';
						foreach($statusyesno as $stat){
							echo '<option value="'.$stat['id'].'"'; if($stat['id'] == '2'){echo'selected';} echo'>'.$stat['name'].'</option>';
						}
						echo '
				</select>
			</div>
		</div>
	</div>
	<div class="row mt-sm">
		<!-- div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Phone <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_phone" id="std_phone" value="'.$rowsvalues['cell_no'].'" required title="Must Be Required">
			</div>
		</div -->
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Whatsapp  <span class="required">*</span></label>
				<input type="text" class="form-control" id="std_whatsapp"  value="'.$rowsvalues['cell_no'].'" name="std_whatsapp" required title="Must Be Required">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Email </label>
				<input type="email" class="form-control" id="std_email" name="std_email">
			</div>
		</div>
	</div>

	<div class="row mt-sm">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Date of Birth </label>
				<input type="text" class="form-control" name="std_dob" id="std_dob" data-plugin-datepicker>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Blood Group </label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_bloodgroup">
					<option value="">Select</option>';
					foreach($bloodgroup as $listblood){
						echo '<option value="'.$listblood.'">'.$listblood.'</option>';
					}
					echo '
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Religion </label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="std_religion">
					<option value="">Select</option>';
					foreach($religion as $rel)
					{
						echo' <option value="'.$rel.'">'.$rel.'</option>';
					}
					echo'
				</select>
			</div>
		</div>
	</div>

	<div class="row mt-sm">
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label">Group </label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_group">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT group_id, group_name 
											FROM ".GROUPS."
											WHERE group_status = '1'
											ORDER BY group_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['group_id'].'">'.$valuecls['group_name'].'</option>';
						}
						echo '
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Class <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_class" onchange="get_classsection(this.value)">
				<option value="">Select</option>';
					$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name, class_code 
										FROM ".CLASSES."
										WHERE class_status = '1' 
										ORDER BY class_id ASC");
					while($valuecls = mysqli_fetch_array($sqllmscls)) {
						echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_code'].'" '; if($valuecls['class_id'] == $rowsvalues['id_class']){echo'selected';} echo'>'.$valuecls['class_name'].'</option>';
					}
					echo '
			</select>
		</div>
		<div id="getclasssection">
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Section </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_section">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
											FROM ".CLASS_SECTIONS."
											WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
											AND section_status = '1' AND id_class = '".$rowsvalues['id_class']."' AND is_deleted != '1'
											ORDER BY section_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
						}
						echo'
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Roll No.</label>
					<input type="text" class="form-control" name="std_rollno" id="std_rollno" value="'.$newRollno.'" readonly/>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-sm">		
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label">Is Hostelized <span class="required">*</span></label>
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="is_hostelized" required>
					<option value="">Select</option>';
					foreach($statusyesno as $hostel)
					{
						echo' <option value="'.$hostel['id'].'">'.$hostel['name'].'</option>';
					}
					echo'
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label">Previous Balance</label>
				<input type="number" class="form-control" name="remaining_amount" id="remaining_amount">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label">Admission Date <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_admissiondate" id="std_admissiondate" value="'.$today.'" data-plugin-datepicker required title="Must Be Required">
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label">City</label>
				<input type="text" class="form-control" name="std_city" id="std_city">
			</div>
		</div>
	</div>
	<div class="row mt-sm">
		<div class="col-sm-12">
			<div class="form-group">
				<label class="control-label">Address </label>
				<textarea type="text" class="form-control" name="std_address" id="std_address">'.$rowsvalues['address'].'</textarea>
			</div>
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
		</div>
	</div>
</footer>
</div>
</form>
</section>
</div>
</div>';
}
else{
	header("Location: students.php");
}
?>