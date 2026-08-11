<?php 	
//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT e.emply_id, e.emply_status, e.emply_regno, e.emply_name, e.id_dept, 
								e.id_designation, e.id_type, e.emply_gender, e.emply_dob, e.emply_joindate,
								e.emply_education, e.emply_experence, e.emply_religion, e.emply_bloodgroup,
								e.emply_address, e.emply_phone, e.emply_email, e.emply_photo,
								d.dept_name, dp.designation_name 
								FROM ".EMPLOYEES." e 
								INNER JOIN ".DEPARTMENTS." d ON d.dept_id = e.id_dept
								INNER JOIN ".DESIGNATIONS." dp ON dp.designation_id = e.id_designation
								WHERE e.emply_id = '".cleanvars($_GET['id'])."' LIMIT 1");
$rowsvalues = mysqli_fetch_array($sqllms);
//-----------------------------------------------------
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
 <input type="hidden" name="emply_id" id="emply_id" value="'.cleanvars($_GET['id']).'">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">';
						if($rowsvalues['emply_photo']) { 
    					echo'
							<img src="uploads/images/employees/'.$rowsvalues['emply_photo'].'" class="rounded img-responsive">' ;
    					} else {
				 			echo "No Image";
						}
   			 			echo'
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="emply_name" id="emply_name" value="'.$rowsvalues['emply_name'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Registration Number <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="emply_regno" id="emply_regno" value="'.$rowsvalues['emply_regno'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Type <span class="required">*</span></label>
			<div class="col-md-8">
				
				  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
					  <option value="'.$rowsvalues['id_type'].'">'.get_emplytype($rowsvalues['id_type']).'</option>
					  <option value="1">Non Teaching</option>
					  <option value="2">Teaching</option>
				  </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Department <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_dept">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT dept_id, dept_name 
													FROM ".DEPARTMENTS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY dept_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['dept_id'] == $rowsvalues['id_dept']) { 
								echo '<option value="'.$valuecls['dept_id'].'" selected>'.$valuecls['dept_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['dept_id'].'">'.$valuecls['dept_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Designation <span class="required">*</span></label>
			<div class="col-md-8">
				<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_designation">
					<option value="">Select</option>';
						$sqllmscls	= $dblms->querylms("SELECT designation_id, designation_name 
													FROM ".DESIGNATIONS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY designation_name ASC");
						while($valuecls = mysqli_fetch_array($sqllmscls)) {
							if($valuecls['designation_id'] == $rowsvalues['id_designation']) { 
								echo '<option value="'.$valuecls['designation_id'].'" selected>'.$valuecls['designation_name'].'</option>';
							} else { 
								echo '<option value="'.$valuecls['designation_id'].'">'.$valuecls['designation_name'].'</option>';
							}
						}
				echo '
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Education <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="emply_education" value="'.$rowsvalues['emply_education'].'" data-plugin-options=\'{ "startView": 2 }\' />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Experience <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="emply_experence" id="emply_experence" value="'.$rowsvalues['emply_experence'].'" data-plugin-options=\'{ "startView": 2 }\' />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Date of Birth <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="emply_dob" value="'.$rowsvalues['emply_dob'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Joining Date <span class="required">*</span></label> 
			<div class="col-md-8">
				<input type="text" class="form-control" name="emply_joindate" value="'.$rowsvalues['emply_joindate'].'" data-plugin-datepicker />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Gender <span class="required">*</span></label>
			<div class="col-md-8">
				<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="emply_gender" class="form-control populate">
					<option value="'.$rowsvalues['emply_gender'].'">'.$rowsvalues['emply_gender'].'</option>	
					<option value="male" >Male</option>
					<option value="female" >Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Religion <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="emply_religion" value="'.$rowsvalues['emply_religion'].'"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Blood group <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="emply_bloodgroup" value="'.$rowsvalues['emply_bloodgroup'].'" class="form-control populate" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
					<option value="'.$rowsvalues['emply_bloodgroup'].'">'.$rowsvalues['emply_bloodgroup'].'</option>
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
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
					<input type="text" class="form-control" name="emply_phone" value="'.$rowsvalues['emply_phone'].'" />
				</div>
			</div>
		</div>
		<div class="form-group mb-md">
			<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" name="emply_email" required id="email" value="'.$rowsvalues['emply_email'].'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Address <span class="required">*</span></label>
			<div class="col-md-8">
				<textarea name="emply_address" rows="2" class="form-control" value="" aria-required="true">'.$rowsvalues['emply_address'].'</textarea>
			</div>
		</div>
		<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">';
				if($rowsvalues['emply_status'] == 1) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="emply_status" name="emply_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="emply_status" name="emply_status" value="1">
							<label for="radioExample1">Active</label>
						</div>';
				}
				if($rowsvalues['emply_status'] == 2) { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="emply_status" name="emply_status" checked value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				} else { 
					echo '
						<div class="radio-custom radio-inline">
							<input type="radio" id="emply_status" name="emply_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>';
				}
				echo '		
					</div>
				</div>
	</fieldset>
</form>
</div>';