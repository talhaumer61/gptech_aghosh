<?php 
//-----------------------------------------------
if(($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '22', 'added' => '1'))){ 
echo'
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Employee</h4>
</div>

<div class="panel-body">
    
<label class="control-label">Photo</label>
<div class="row">
	<div class="col-md-6">
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<div class="fileinput-new thumbnail" style="width: 130px; height: 130px;" data-trigger="fileinput">
				<img src="uploads/default-student.jpg" alt="...">
			</div>
			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 130px"></div>
			<div>
				<span class="btn btn-xs btn-default btn-file">
					<span class="fileinput-new">Select image</span>
					<span class="fileinput-exists">Change</span>
					<input type="file" name="emply_photo" accept="image/*">
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
			<input type="text" class="form-control" name="emply_name" id="emply_name" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Reg. No <span class="required">*</span></label>
			<input type="text" class="form-control" name="emply_regno" required title="Must Be Required" value="" >
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			  <input type="text" class="form-control" required title="Must Be Required" name="emply_phone" id="emply_phone"/>
	  	</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Email <span class="required">*</span></label>
			 <input type="text" class="form-control" required title="Must Be Required" name="emply_email" id="emply_email"/>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Employee Type <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
			  <option value="">Select</option>
			  <option value="1">Non Teaching</option>
			  <option value="2">Teaching</option>
			</select>
	  	</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Department <span class="required">*</span></label>
			<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_dept">
					  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT dept_id, dept_name 
													  FROM ".DEPARTMENTS."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  ORDER BY dept_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  echo '<option value="'.$valuecls['dept_id'].'">'.$valuecls['dept_name'].'</option>';
					  }
			  echo '
				  </select>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Designation <span class="required">*</span></label>
			 <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_designation">
					  <option value="">Select</option>';
						  $sqllmscls	= $dblms->querylms("SELECT designation_id, designation_name 
													  FROM ".DESIGNATIONS."
													  WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													  ORDER BY designation_name ASC");
					  while($valuecls = mysqli_fetch_array($sqllmscls)) {
						  echo '<option value="'.$valuecls['designation_id'].'">'.$valuecls['designation_name'].'</option>';
					  }
			  echo '
				  </select>
	  	</div>
	</div>
</div>

<div class="row mt-sm">
	
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Qualification <span class="required">*</span></label>
			 <input type="text" class="form-control" name="emply_education" id="emply_education" required title="Must Be Required"/>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Experience <span class="required">*</span></label>
			<input type="text" class="form-control" required title="Must Be Required" name="emply_experence" id="emply_experence"/>
	  	</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Religion <span class="required">*</span></label>
			  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="emply_religion">
					  <option value="">Select</option>';
					  foreach($religion as $rel)
					  {
						  echo'
					  		<option value="'.$rel.'">'.$rel.'</option>
					  	';
					  }
					  echo'
				  </select>
	  	</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Blood Grouop <span class="required">*</span></label>
			 <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="emply_bloodgroup">
					  <option value="">Select</option>';
					 foreach($bloodgroup as $listblood)
					 {
						echo'
					  	<option value="'.$listblood.'">'.$listblood.'</option>
						';
					 }
					echo'
				  </select>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="control-label">Gender <span class="required">*</span></label>
			 <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="emply_gender">
					  <option value="">Select</option>';
					  foreach($gender as $gen)
					  {
						  echo '<option value="'.$gen.'">'.$gen.'</option>';
					  }
				echo'
				  </select>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Join Date <span class="required">*</span></label>
			<input type="text" class="form-control" data-plugin-datepicker required title="Must Be Required" name="emply_joindate" id="emply_joindate"/>
	  	</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Birthday <span class="required">*</span></label>
			<input type="text" class="form-control" data-plugin-datepicker required title="Must Be Required" name="emply_dob" id="emply_dob"/>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Address</label>
			<textarea type="text" class="form-control" required title="Must Be Required" name="emply_address" id="emply_address"></textarea>
		</div>
	</div>
</div>

<div class="form-group mt-sm mb-sm">
	<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
	<div class="col-md-9">
		<div class="radio-custom radio-inline">
			<input type="radio" id="emply_status" name="emply_status" value="1" checked>
			<label for="radioExample1">Active</label>
		</div>
		<div class="radio-custom radio-inline">
			<input type="radio" id="emply_status" name="emply_status" value="2">
			<label for="radioExample2">Inactive</label>
		</div>
	</div>
</div>

</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" class="mr-xs btn btn-primary" id="submit_emply" name="submit_emply">Add Employee</button>
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
	header("Location: employee.php");
}
//-----------------------------------------------