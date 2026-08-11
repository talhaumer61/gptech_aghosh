
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="gallery/maintain/update/2" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
            		<i class="glyphicon glyphicon-edit"></i>
					Edit            	</h4>
			</div>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="title" required title="Must Be Required" value="FX 4K - Loket Hart">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Video URL <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="url" class="form-control" name="youtube_link" required value="https://www.youtube.com/watch?v=8yN1Q6vV0gk&t=9s">
					</div>
				</div>

				<div class="form-group">
					<label for="field-2" class="col-md-3 control-label">Subtitle <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" data-plugin-maxlength maxlength="50" class="form-control" name="description" required title="Must Be Required" value="PVS Fire FX 4K is Released with Realtime Projects">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Visible For <span class="required">*</span></label>
					<div class="col-md-9">
						<select name="visible_type" class='form-control' id='employee_name_holder' required
							data-plugin-selectTwo data-width='100%' onchange= 'return get_student_hidden(this.value)' data-minimum-results-for-search='Infinity' >
<option value="1">Everyone</option>
<option value="2" selected="selected">Student</option>
</select>
					</div>
				</div>
				
				<div id = "student_hidden"  >
					<div class="form-group">
						<label class="col-md-3 control-label">Class <span class="required">*</span></label>
						<div class="col-md-9">
							<select name="class_id" class='form-control' onchange = 'return get_class_sections(this.value)' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' >
<option value="">Select</option>
<option value="1" selected="selected">One</option>
</select>
						</div>
					</div>
					<div class="form-group mb-md">
						<label class="col-md-3 control-label">Section <span class="required">*</span></label>
						<div class="col-md-9">
							<select name="section_id" class='form-control' id='section_selector_holder' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' >
<option value="">Select Class First</option>
<option value="1" selected="selected">A</option>
</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Thumbnail <span class="required">*</span></label>
					<div class="col-md-6">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 220px; height: 110px;" data-trigger="fileinput">
								<img src="uploads/gallery_thumbnail/2.jpg" alt="...">
							</div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
							<div>
								<span class="mr-xs btn btn-sm btn-default btn-file">
								<span class="fileinput-new">Select image</span>
							
								<span class="fileinput-exists">Change</span>
								<input type="file" name="galleryfile" accept="image/*">
								</span>
								<a href="#" class="btn btn-sm btn-warning fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
			</form>		</section>
	</div>
</div>
