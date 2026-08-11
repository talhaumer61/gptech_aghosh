<?php 
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<fieldset class="mt-lg">
		<div class="form-group">
			<label class="col-sm-3 control-label">Photo</label>
			<div class="col-md-8">
				<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
						<img src="uploads/admin_image/1.jpg" alt="...">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
					<div>
						<span class="mr-xs btn btn-xs btn-default btn-file">
							<span class="fileinput-new">Select image</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="userfile" accept="image/*">
						</span>
						<a href="#" class="btn btn-xs btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="name" value="Admin"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Birthday <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="birthday" value="10/01/1994" data-plugin-datepicker data-plugin-options=\'{ "startView": 2 }\' />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Joining Date <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="joining_date" value="07/10/2010" data-plugin-datepicker data-plugin-options=\'{ "todayHighlight" : true }\' />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Gender <span class="required">*</span></label>
			<div class="col-md-8">
				<select data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="sex" class="form-control populate">
					<option value="">Select</option>
					<option value="male" selected>Male</option>
					<option value="female" >Female</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Religion <span class="required">*</span></label>
			<div class="col-md-8">
				<input type="text" class="form-control" required name="religion" value="Hindu"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Blood group <span class="required">*</span></label>
			<div class="col-md-8">
				<select name="blood_group" class="form-control populate" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" >
					<option value="">Select</option>
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
		<div class="form-group">
			<label class="col-sm-3 control-label">Address <span class="required">*</span></label>
			<div class="col-md-8">
				<textarea name="address" rows="2" class="form-control" placeholder="Student Address Here" aria-required="true">Khulna - 9210, Bangladesh</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Phone <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
					<input type="text" class="form-control" name="phone" value="+1875013567522" />
				</div>
			</div>
		</div>
		<div class="form-group mb-md">
			<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
			<div class="col-md-8">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="email" class="form-control" name="email" required id="email" value="admin@rudras.com" />
				</div>
			</div>
		</div>
	</fieldset>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary">Update Profile</button>
			</div>
		</div>
	</div>
</form>
</div>';