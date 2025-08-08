<?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT s.std_id, s.std_status, s.std_name, s.std_fathername, s.std_gender, s.id_guardian,
								s.std_nic, s.std_phone, s.std_whatsapp, s.std_email, s.is_orphan, s.id_class, s.id_section, s.id_group,
								s.id_session,  s.std_rollno, s.std_regno, s.std_photo, s.std_gender, s.std_dob, s.std_bloodgroup,
								s.id_country, s.std_city, s.std_religion, s.std_address, s.std_admissiondate, s.transport_fee,
								s.id_donor, s.donation_amount, s.donation_duration,
								c.class_id, c.class_status, c.class_name,
								se.section_id, se.section_status, se.section_name, 
								gr.group_id, gr.group_status, gr.group_name 
								FROM ".STUDENTS." s
								INNER JOIN ".CLASSES." c ON c.class_id = s.id_class
								LEFT JOIN ".CLASS_SECTIONS." se ON se.section_id = s.id_section
								LEFT JOIN ".GROUPS." gr ON gr.group_id = s.id_group
								WHERE s.id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
								AND s.std_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 <input type="hidden" name="std_id" id="std_id" value="'.cleanvars($_GET['id']).'">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">';
						if($rowsvalues['std_photo']) { 
    						echo '<img src="uploads/images/students/'.$rowsvalues['std_photo'].'" class="rounded img-responsive">' ;
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
			<label class="col-sm-3 control-label">Roll No</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_rollno" id="std_rollno" value="'.$rowsvalues['std_rollno'].'" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Group</label>
			<div class="col-md-8">
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_group">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT group_id, group_name 
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
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_class" onchange="get_editclasssection(this.value)">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT class_id, class_code, class_name 
													FROM ".CLASSES."
													WHERE class_status = '1'
													ORDER BY class_id ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['class_id'] == $rowsvalues['id_class']) { 
								echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_code'].'" selected>'.$valuecls['class_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['class_id'].'|'.$valuecls['class_code'].'">'.$valuecls['class_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div id="geteditclasssection">
			<div class="form-group mb-lg">
				<label class="col-md-3 control-label">Section</label>
				<div class="col-md-8">
					<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_section">
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT section_id, section_name 
														FROM ".CLASS_SECTIONS."
														WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
														AND section_status = '1' AND id_class = '".$rowsvalues['id_class']."' 
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
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Is Orphan <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="is_orphan" class="form-control populate" data-plugin-selectTwo data-width="100%" required title="Must Be Required">
					<option value="">Select</option>';
					foreach($statusyesno as $stat){
						echo '<option value="'.$stat['id'].'"'; if($rowsvalues['is_orphan'] == $stat['id']){echo ' selected';}echo'>'.$stat['name'].'</option>';
					}
					echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_phone" value="'.$rowsvalues['std_phone'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Whatsapp</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_whatsapp" value="'.$rowsvalues['std_whatsapp'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Email</label>
			<div class="col-md-8">
				<input type="email" class="form-control" name="std_email" value="'.$rowsvalues['std_email'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Gender <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="std_gender" data-plugin-selectTwo data-width="100%" class="form-control populate" required title="Must Be Required">
					<option value="">Select</option>
						<option value="Male"'; if($rowsvalues['std_gender'] == 'Male'){ echo 'selected';} echo'>Male</option>
						<option value="Female"'; if($rowsvalues['std_gender'] == 'Female'){ echo 'selected';} echo'>Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Blood Group</label>
			<div class="col-md-8">
				<select name="std_bloodgroup" class="form-control populate" data-plugin-selectTwo data-width="100%" >
					<option value="">Select</option>';
					foreach($bloodgroup as $listblood){
						echo '<option value="'.$listblood.'"'; if($rowsvalues['std_bloodgroup'] == $listblood){echo ' selected';}echo'>'.$listblood.'</option>';
					}
					echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Date of Birth</label> 
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_dob" value="'.$rowsvalues['std_dob'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">NIC / B-Form <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_nic" value="'.$rowsvalues['std_nic'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Religion</label>
			<div class="col-md-8">
				<select name="std_religion" value="'.$rowsvalues['std_religion'].'" class="form-control populate" data-plugin-selectTwo data-width="100%" >';
					 foreach($religion as $rel)
					 {
						echo '<option value="'.$rel.'"'; if($rowsvalues['std_religion'] == $rel){echo ' selected';} echo '>'.$rel.'</option>';
					 }
					echo'
				  </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Admission Date <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="std_admissiondate" value="'.$rowsvalues['std_admissiondate'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Transport Fee </label>
			<div class="col-md-8">
				<input type="number" class="form-control" name="transport_fee" value="'.$rowsvalues['transport_fee'].'" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Guardian</label>
			<div class="col-md-8">
				<select class="form-control" data-plugin-selectTwo data-width="100%" name="id_guardian">
					<option value="">Select</option>';
					foreach($guardian as $value){
					echo '<option value="'.$value['id'].'"'; if($rowsvalues['id_guardian'] == $value['id']){echo ' selected';} echo'>'.$value['name'].'</option>';
					}
					echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">City</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="std_city" value="'.$rowsvalues['std_city'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Address</label>
			<div class="col-md-8">
				<textarea type="text" class="form-control" name="std_address">'.$rowsvalues['std_address'].'</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
			<div class="col-md-9">';
				foreach($stdstatus as $stdstat){
					echo'
					<div class="radio-custom radio-inline">
						<input type="radio" id="std_status" name="std_status" value="'.$stdstat['id'].'"'; if($rowsvalues['std_status'] == $stdstat['id']){ echo'checked';} echo'>
						<label for="radioExample1">'.$stdstat['name'].'</label>
					</div>';
				}
				echo '		
			</div>
		</div>
	</fieldset>
	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit"  name="changes_student" id="changes_student" class="btn btn-primary">Update Profile</button>
			</div>
		</div>
	</div>
</form>
</div>';