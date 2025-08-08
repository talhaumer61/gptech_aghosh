<?php 
echo '
<div id="edit" class="tab-pane active">
<form action="#" class="validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<fieldset class="mb-xl mt-lg">
	
		<div class="row">
			<div class="col-md-7">
				<div class="form-group">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
							<img src="uploads/parent_image/1.jpg" alt="...">
						</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
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
		</div>
		
		<div class="row">
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Guardian Name <span class="required">*</span></label>
					<input type="text" class="form-control" name="guardian_name" value="Krishna Ray" required title="Must Be Required" />
				</div>
			</div>
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Relation</label>
					<input type="text" class="form-control" name="relation" value="Father" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Father Name</label>
					<input type="text" class="form-control" name="father_name" value="Krishna Ray" />
				</div>
			</div>
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Father Occupation</label>
					<input type="text" class="form-control" name="father_occupation" value="Teacher" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Mother Name</label>
					<input type="text" class="form-control" name="mother_name" value="Shefali Roy" />
				</div>
			</div>
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Mother Occupation</label>
					<input type="text" class="form-control" name="mother_occupation" value="Housewife" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 mb-xs">
				<div class="form-group ">
					<label class="control-label">Email <span class="required">*</span></label>
					<input type="email" class="form-control" name="email" value="parent@rudras.com" required title="Must Be Required"/>
				</div>
			</div>
			<div class="col-md-6 mb-xs">
				<div class="form-group">
					<label class="control-label">Phone <span class="required">*</span></label>
					<input type="text" class="form-control" name="phone" value="+1-1724-904347" required title="Must Be Required" />
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Address</label>
					<textarea class="form-control" rows="3" name = "address">4th Av & F St, Chula Vista, CA 91910, USA</textarea>
				</div>
			</div>
		</div>
	
	</fieldset>
	<div class="panel-footer">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</form>
</div>';