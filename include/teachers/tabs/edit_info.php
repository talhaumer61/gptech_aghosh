<?php 
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<fieldset class="mt-lg">
	<label class=" control-label">Photo</label>
	<div class="row">
		<div class="col-md-6">
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
					<img src="uploads/teacher_image/1.jpg" alt="...">
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px"></div>
				<div>
					<span class="btn btn-xs btn-default btn-file">
						<span class="fileinput-new">Select image</span>
						<span class="fileinput-exists">Change</span>
						<input type="file" name="userfile" accept="image/*">
					</span>
					<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row mt-sm">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" class="form-control" name="name" required title="Must Be Required" value="Anzo Perez" autofocus>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Department <span class="required">*</span></label>
				<input type="text" class="form-control" name="department" required title="Must Be Required" value="Physics" >
			</div>
		</div>
	</div>
	
	<div class="row mt-sm">
		<div class="col-sm-12">
			<div class="form-group">
				<label class="control-label">Gender</label>
				<select name="sex" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate">
					<option value="">Select</option>
					<option value="male" >Male</option>
					<option value="female" selected>Female</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="row mt-sm">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Qualification <span class="required">*</span></label>
				<input type="text" class="form-control" name="qualification" required title="Must Be Required" value="PHD">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Designation <span class="required">*</span></label>
				<select name="designation" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" class="form-control populate" required title="Must Be Required" >
					<option value="">Select</option>
					<option value="1" selected>General teacher</option>
					<option value="2" >Principal</option>
					<option value="3" >TESTE</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="row mt-sm">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Birthday <span class="required">*</span></label>
				<input type="text" class="form-control" name="birthday" value="07/22/1994" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\'>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Joining Date <span class="required">*</span></label>
				<input type="text" class="form-control" name="joining_date" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\' required
			title="Must Be Required" value="08/12/2016">
			</div>
		</div>
	</div>
	
	<div class="row mt-sm">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Religion <span class="required">*</span></label>
				<input type="text" class="form-control" name="religion" required title="Must Be Required" value="Christian">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Blood group <span class="required">*</span></label>
				<select name="blood_group" class="form-control populate" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity">
					<option value="A+" selected="selected">A+</option>
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
		<div class="col-sm-12">
			<div class="form-group">
				<label class="control-label">Address <span class="required">*</span></label>
				<textarea class="form-control" rows="2" name="address" required title="Must Be Required">Washington, DC 96503, USA</textarea>
			</div>
		</div>
	</div>
	
	<div class="row mt-sm mb-sm">
		<div class="col-sm-6">
			<div class="form-group ">
				<label class="control-label">Email <span class="required">*</span></label>
				<input type="email" class="form-control" name="email" required value="teacher@rudras.com">
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label">Phone <span class="required">*</span></label>
				<input type="text" class="form-control" name="phone" value="+1-60-45316845" required title="Must Be Required">
			</div>
		</div>
	</div>
</fieldset>
<div class="panel-footer">
	<button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
</div>';