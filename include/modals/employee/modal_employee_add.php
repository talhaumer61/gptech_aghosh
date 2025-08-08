  <?php 
  echo '
  <!-- Add Modal Box -->
  <div id="make_employee" class="zoom-anim-dialog modal-block modal-block-primary modal-dialog modal-xl mfp-hide">
	  <section class="panel panel-featured panel-featured-primary">
		  <form action="employee.php" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	  <header class="panel-heading">
		  <h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Employee</h2>
	  </header>
	  <div class="panel-body">
<div class="form-group mt-xl">
<div class="row">
	<div class="col-md-4"></div>
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
	<div class="col-md-2"></div>
</div>
</div>

		  <div class="form-group mt-sm">
			  <label class="col-md-3 control-label">Employee Name <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" name="emply_name" id="emply_name" required title="Must Be Required"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Registartion Number <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" required title="Must Be Required" name="emply_regno" id="emply_regno"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Employee Type <span class="required">*</span></label>
			  <div class="col-md-9">
				  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_type">
					  <option value="">Select</option>
					  <option value="1">Non Teaching</option>
					  <option value="2">Teaching</option>
				  </select>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Department <span class="required">*</span></label>
			  <div class="col-md-9">
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
		  <div class="form-group">
			  <label class="col-md-3 control-label">Designation <span class="required">*</span></label>
			  <div class="col-md-9">
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
		  <div class="form-group">
			  <label class="col-md-3 control-label">Date of Birth <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" data-plugin-datepicker required title="Must Be Required" name="emply_dob" id="emply_dob"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Join Date<span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" data-plugin-datepicker required title="Must Be Required" name="emply_joindate" id="emply_joindate"/>
			  </div>
		  </div>
		  <div class="form-group mt-sm">
			  <label class="col-md-3 control-label">Education <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" name="emply_education" id="emply_education" required title="Must Be Required"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Experienece <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" required title="Must Be Required" name="emply_experence" id="emply_experence"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Phone <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" required title="Must Be Required" name="emply_phone" id="emply_phone"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Email <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" required title="Must Be Required" name="emply_email" id="emply_email"/>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-sm-3 control-label">Religion <span class="required">*</span></label>
			  <div class="col-md-9">
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
		  <div class="form-group">
			  <label class="col-sm-3 control-label">Blood Group <span class="required">*</span></label>
			  <div class="col-md-9">
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
		  <div class="form-group">
			  <label class="col-sm-3 control-label">Gender <span class="required">*</span></label>
			  <div class="col-md-9">
				  <select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="emply_gender">
					  <option value="">Select</option>';
					  foreach($gender as $gen)
					  {
						  echo'
					  		<option value="'.$gen.'">'.$gen.'</option>
					  	';
					  }
					  echo'
				  </select>
			  </div>
		  </div>
		  <div class="form-group">
			  <label class="col-md-3 control-label">Address <span class="required">*</span></label>
			  <div class="col-md-9">
				  <input type="text" class="form-control" required title="Must Be Required" name="emply_address" id="emply_address"/>
			  </div>
		  </div>
		  <div class="form-group">
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
				  <button type="submit" class="btn btn-primary" id="submit_emply" name="submit_emply">Save</button>
				  <button class="btn btn-default modal-dismiss">Cancel</button>
			  </div>
		  </div>
	  </footer>
  </form>
  </section>
  </div>
  <script type="text/javascript">
	  jQuery(document).ready(function ($) {
		  $("form#frm").validate({
			  rules: {
				  room_beds: {
					  number: true
				  },
				  room_bedfee: {
					  number: true
				  }
			  },
  
			  messages: {
				  room_beds: {
					  number: \'Please enter a valid number.\'
				  },
  
				  room_bedfee: {
					  number: \'Please enter a valid number.\'
				  }
			  },
  
			  errorPlacement: function (error, element) {
				  var placement = element.closest(\'.input-group\');
				  if (!placement.get(0)) {
					  placement = element;
				  }
				  if (error.text() !== \'\') {
					  if (element.parent(\'.checkbox, .radio\').length || element.parent(\'.input-group\').length) {
						  placement.after(error);
					  } else {
						  var placement = element.closest(\'div\');
						  placement.append(error);
						  wrapper: "li"
					  }
				  }
			  }
		  });
	  });
  </script>';