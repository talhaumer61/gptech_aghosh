<?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status, s.std_firstname, s.std_lastname, s.std_gender, s.id_guardian,
								   s.std_nic, s.std_phone, s.id_class, s.id_section, s.id_group, s.id_session,  s.std_rollno,
								   s.std_regno, s.std_photo, s.std_gender, s.std_dob, s.std_bloodgroup, s.id_country,
								   s.std_city, s.std_religion, s.std_address, s.std_admissiondate,
								   g.guardian_id, g.guardian_status, g.guardian_name,
								   c.class_id, c.class_status, c.class_name,
								   se.section_id, se.section_status, se.section_name, 
								   gr.group_id, gr.group_status, gr.group_name 
								   FROM ".STUDENTS." s
								   INNER JOIN ".GUARDIANS."		  g  ON g.guardian_id 	= s.id_guardian
								   INNER JOIN ".CLASSES."         c  ON c.class_id 	   	= s.id_class
								   INNER JOIN ".CLASS_SECTIONS."  se ON se.section_id   = s.id_section
								   INNER JOIN ".GROUPS."  		  gr ON gr.group_id   	= s.id_group
								   WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								   AND s.std_id = '".cleanvars($_GET['id'])."' LIMIT 1");
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
				 			echo "No Image";
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
			<label class="col-sm-3 control-label">First Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_firstname" id="std_firstname" value="'.$rowsvalues['std_firstname'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Last Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_lastname" id="std_lastname" value="'.$rowsvalues['std_lastname'].'"/>
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
			<label class="col-md-3 control-label">Session <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_session">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT session_id, session_status, session_name 
													FROM ".SESSIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY session_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['session_id'] == $rowsvalues['id_session']) { 
								echo '<option value="'.$valuecls['session_id'].'" selected>'.$valuecls['session_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['session_id'].'">'.$valuecls['session_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Group <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_group">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT group_id, group_status, group_name 
													FROM ".GROUPS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
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
						$sqllmscls	= $dblms->querylms("SELECT class_id, class_status, class_name 
													FROM ".CLASSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
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
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
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
				<input type="text" class="form-control" name="std_gender" id="std_gender" value="'.$rowsvalues['std_gender'].'" data-plugin-options=\'{ "startView": 2 }\' />
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
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
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
			<label class="col-sm-3 control-label">Country <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="id_country" value="'.$rowsvalues['id_country'].'"/>
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