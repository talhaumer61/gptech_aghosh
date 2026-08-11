<?php 
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="frm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
                <h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Subject</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
						<label class="col-md-3 control-label">
							Subject Name <span class="required">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="name" required value="English"/>
						</div>
					</div>

				<div class="form-group">
						<label class="col-md-3 control-label">
							Subject Code <span class="required">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="subject_code" required value="101"/>
						</div>
					</div>
				<div class="form-group">
						<label class="col-md-3 control-label">
							Full Mark <span class="required">*</span>
						</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="full_mark" id="full_mark" required title="Must Be Required" value="100"/>
						</div>
					</div>
				<div class="form-group">
						<label class="col-md-3 control-label">
							Pass Mark <span class="required">*</span>
						</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="pass_mark" id="pass_mark" required title="Must Be Required" value="33"/>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-md-3 control-label">
							Subject Author						</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="subject_author" value=""/>
						</div>
					</div>

				<div class="form-group">
						<label class="col-md-3 control-label">Subject Type <span class="required">*</span></label>
						<div class="col-md-9">
						<select name="subject_type" class="form-control populate" data-plugin-selectTwo data-width="100%" required title = "Value Required"data-minimum-results-for-search="Infinity" >
<option value="Theory" selected="selected">Theory</option>
<option value="Practical">Practical</option>
<option value="Optional">Optional</option>
<option value="Mandatory">Mandatory</option>
</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Class <span class="required">*</span></label>
						<div class="col-md-9">
							<select name="class_id" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required>
																<option value="1" selected>One</option>
															</select>
						</div>
					</div>

					<div class="form-group mb-md">
						<label class="col-md-3 control-label">Teacher <span class="required">*</span></label>
						<div class="col-md-9">
							<select name="teacher_id" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate"
							required title="Must Be Required">
								<option value="">Select Teacher</option>
								  								<option value="1" selected>Anzo Perez</option>
																<option value="2" >Johanna Luisa</option>
															</select>
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
			</form>
		</section>
    </div>
</div>';