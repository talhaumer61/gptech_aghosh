<?php
//--------------------------------------------
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
	include_once("../footer.php");
//--------------------------------------------
if(isset($_POST['form_no'])) {
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT * FROM ".ADMISSIONS_INQUIRY." WHERE form_no = '".$_POST['form_no']."' AND is_deleted != '1' AND id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' LIMIT 1");
//--------------------------------------------
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
    if (mysqli_num_rows($sqllms) == 1) {
    $rowsvalues = mysqli_fetch_array($sqllms);
    echo '
    
    
	<div class="row mt-sm">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Student Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_name" id="std_name" value="'.$rowsvalues['name'].'"  required title="Must Be Required" autofocus>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Father Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_fathername" id="std_fathername" value="'.$rowsvalues['fathername'].'"  required title="Must Be Required" >
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Gender <span class="required">*</span></label>
                <select name="std_gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
                    <option value="Male"'; if($rowsvalues['gender'] == 'Male'){ echo 'selected';} echo'>Male</option>
                    <option value="Female"'; if($rowsvalues['gender'] == 'Female'){ echo 'selected';} echo'>Female</option>
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
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Phone <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_phone" id="std_phone"  value="'.$rowsvalues['cell_no'].'" required title="Must Be Required">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Whatsapp </label>
				<input type="text" class="form-control" id="std_whatsapp" name="std_whatsapp">
			</div>
		</div>
		<div class="col-sm-4">
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
				echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_code'].'">'.$valuecls['class_name'].'</option>';
				}
			echo '
			</select>
		</div>
		<div id="getclasssection">
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Section </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_section">
						<option value="">Select</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Roll No.</label>
					<input type="text" class="form-control" name="std_rollno" value="'.$newRollno.'" id="std_rollno" readonly>
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
	</div>';
    //---------------------------------------
    }
    else{
    echo '
    
	<div class="row mt-sm">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Student Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_name" id="std_name" required title="Must Be Required" autofocus>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Father Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_fathername" id="std_fathername" required title="Must Be Required" >
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Gender <span class="required">*</span></label>
				<select name="std_gender" data-plugin-selectTwo data-width="100%" class="form-control populate" required title="Must Be Required">
					<option value="">Select</option>
					<option value="Male" >Male</option>
					<option value="Female" >Female</option>
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
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Phone <span class="required">*</span></label>
				<input type="text" class="form-control" name="std_phone" id="std_phone" required title="Must Be Required">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label">Whatsapp </label>
				<input type="text" class="form-control" id="std_whatsapp" name="std_whatsapp">
			</div>
		</div>
		<div class="col-sm-4">
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
				echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_code'].'">'.$valuecls['class_name'].'</option>';
				}
			echo '
			</select>
		</div>
		<div id="getclasssection">
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Section </label>
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_section">
						<option value="">Select</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label class="control-label">Roll No.</label>
					<input type="text" class="form-control" value="'.$newRollno.'" name="std_rollno" id="std_rollno" readonly>
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
				<textarea type="text" class="form-control" name="std_address" id="std_address"></textarea>
			</div>
		</div>
	</div>';
    }
}
?>