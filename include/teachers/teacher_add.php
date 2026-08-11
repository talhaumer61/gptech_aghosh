<?php 
echo '
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="mb-lg validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Add Teacher</h4>
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
			<input type="text" class="form-control" name="name" required title="Must Be Required" value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Department <span class="required">*</span></label>
			<input type="text" class="form-control" name="department" required title="Must Be Required" value="" >
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
				<option value="female" >Female</option>
			</select>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Qualification <span class="required">*</span></label>
			<input type="text" class="form-control" name="qualification" required title="Must Be Required" value="">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Designation <span class="required">*</span></label>
			<select name="designation" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" class="form-control populate" 
			required title="Must Be Required" >
				<option value="">Select</option>
				<option value="1" >General teacher</option>
				<option value="2" >Principal</option>
				<option value="3" >TESTE</option>
			</select>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Birthday </label>
			<input type="text" class="form-control" name="birthday" value="" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\'>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Joining Date <span class="required">*</span></label>
			<input type="text" class="form-control" name="joining_date" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\' required title="Must Be Required" value="">
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Religion</label>
			<input type="text" class="form-control" name="religion" value="">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Blood group</label>
			<select name="blood_group" class="form-control populate" data-plugin-selectTwodata-width="100%" data-minimum-results-for-search="Infinity" >
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
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Address <span class="required">*</span></label>
			<textarea class="form-control" rows="3" name="address" required title="Must Be Required"></textarea>
		</div>
	</div>
</div>

<div class="row mt-sm">
	<div class="col-sm-6">
		<div class="form-group ">
			<label class="control-label">Email <span class="required">*</span></label>
			<input type="email" class="form-control" name="email" required value="" autofocus>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label">Password <span class="required">*</span></label>
			<input type="password" class="form-control" name="password" required title="Must Be Required" value="">
		</div>
	</div>
</div>

<div class="row mt-sm mb-sm">
	<div class="col-sm-12">
		<div class="form-group">
			<label class="control-label">Phone <span class="required">*</span></label>
			<input type="text" class="form-control" name="phone" value="" required title="Must Be Required">
		</div>
	</div>
</div>

</div>
<footer class="panel-footer">
	<div class="row">
		<div class="col-md-12 text-right">
			<button type="submit" class="mr-xs btn btn-primary">Add Teacher</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</footer>
</form>
</section>
</div>
</div>';