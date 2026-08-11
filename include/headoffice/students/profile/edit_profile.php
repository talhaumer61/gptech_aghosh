<?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT  s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender, s.id_guardian,
								s.std_nic, s.std_phone, s.id_class, s.id_section, s.id_group, s.id_session,  s.std_rollno,
								s.std_regno, s.std_photo, s.std_gender, s.std_dob, s.std_bloodgroup, s.id_country,
								s.std_city, s.std_religion, s.std_address, s.std_admissiondate,
								g.guardian_id, g.guardian_status, g.guardian_name,
								c.class_id, c.class_status, c.class_name,
								se.section_id, se.section_status, se.section_name, 
								gr.group_id, gr.group_status, gr.group_name 
								FROM ".STUDENTS." s
								INNER JOIN ".CLASSES."         c  ON c.class_id 	   	= s.id_class
								LEFT JOIN ".CLASS_SECTIONS."  se ON se.section_id   = s.id_section
								LEFT JOIN ".GUARDIANS."		  g  ON g.guardian_id 	= s.id_guardian
								LEFT JOIN ".GROUPS."  		  gr ON gr.group_id   	= s.id_group
								WHERE s.std_id = '".cleanvars($_GET['id'])."' LIMIT 1");
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
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">';
						if($rowsvalues['std_photo']) { 
    					echo'
							<img src="uploads/images/students/'.$rowsvalues['std_photo'].'" class="rounded img-responsive">' ;
    					} else {
				 			echo '<img src="uploads/default-student.jpg" class="rounded img-responsive">';
						}
   			 			echo'
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
					<div>
						<span class="mr-xs btn btn-xs btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="std_photo" accept="image/*">
						</span>
						<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Student Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_name" id="std_name" value="'.$rowsvalues['std_name'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Father Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_fathername" id="std_fathername" value="'.$rowsvalues['std_fathername'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Roll No <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_rollno" id="std_rollno" value="'.$rowsvalues['std_rollno'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Reg No <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_regno" id="std_regno" value="'.$rowsvalues['std_regno'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Group <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_group">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT group_id, group_status, group_name 
													FROM ".GROUPS."
													WHERE group_status = '1' 
													ORDER BY group_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['group_id'] == $rowsvalues['id_group']) { 
								echo '<option value="'.$valuecls['group_id'].'" selected>'.$valuecls['group_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['group_id'].'">'.$valuecls['group_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Class <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE class_status = '1' 
													ORDER BY class_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['class_id'] == $rowsvalues['id_class']) { 
								echo '<option value="'.$valuecls['class_id'].'" selected>'.$valuecls['class_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Section <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_section">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT section_id, section_status, section_name 
													FROM ".CLASS_SECTIONS."
													WHERE section_status = '1' 
													ORDER BY section_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['section_id'] == $rowsvalues['id_section']) { 
								echo '<option value="'.$valuecls['section_id'].'" selected>'.$valuecls['section_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['section_id'].'">'.$valuecls['section_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_phone" value="'.$rowsvalues['std_phone'].'" data-plugin-options=\'{ "startView": 2 }\' />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Gender <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="std_gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
					<option value="">Select</option>
						<option value="male"'; if($rowsvalues['std_gender'] == 'male'){ echo 'selected';} echo'>Male</option>
						<option value="female"'; if($rowsvalues['std_gender'] == 'female'){ echo 'selected';} echo'>Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Blood Group <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="std_bloodgroup" value="'.$rowsvalues['std_bloodgroup'].'" class="form-control populate" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
					<option value="'.$rowsvalues['std_bloodgroup'].'">'.$rowsvalues['std_bloodgroup'].'</option>
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
		<div class="form-group">
			<label class="col-sm-3 control-label">Date of Birth <span class="required">*</span></label> 
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_dob" value="'.$rowsvalues['std_dob'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">NIC <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_nic" value="'.$rowsvalues['std_nic'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Religion <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_religion" value="'.$rowsvalues['std_religion'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Admission Date <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_admissiondate" value="'.$rowsvalues['std_admissiondate'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Guardian <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_guardian">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT guardian_id, guardian_status, guardian_name 
													FROM ".GUARDIANS."
													WHERE guardian_status = '1' 
													ORDER BY guardian_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['guardian_id'] == $rowsvalues['id_guardian']) { 
								echo '<option value="'.$valuecls['guardian_id'].'" selected>'.$valuecls['guardian_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['guardian_id'].'">'.$valuecls['guardian_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">City <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_city" value="'.$rowsvalues['std_city'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Address <span class="required">*</span></label>
			<div class="col-md-8">
				<textarea type="text" class="form-control" required name="std_address">'.$rowsvalues['std_address'].'</textarea>
			</div>
		</div>
		<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
				if($rowsvalues['std_status'] == 1) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" value="1">
							<label for="radioExample1">Active</label>
						</div>';
				}
				if($rowsvalues['std_status'] == 2) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" checked value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="std_status" name="std_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				}
				echo '		
					</div>
				</div>
	</fieldset>
</form>
</div>';