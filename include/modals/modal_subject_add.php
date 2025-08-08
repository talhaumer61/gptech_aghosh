<?php 
echo '
<!-- Add Modal Box -->
<div id="make_subject" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
<form action="#" class="form-horizontal mb-lg" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<div class="panel-heading">
	<h4 class="panel-title"><i class="fa fa-plus-square"></i> Make Subject</h4>
</div>

<div class="panel-body">
<div class="form-group mt-sm">
	<label class="col-md-3 control-label">Subject Name <span class="required">*</span></label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="name" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Subject Code <span class="required">*</span></label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="subject_code" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Subject Author</label>
	<div class="col-md-9">
		<input type="text" class="form-control" name="subject_author" />
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Full Mark <span class="required">*</span></label>
	<div class="col-md-9">
		<input type="number" class="form-control" name="full_mark" id="full_mark" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pass Mark <span class="required">*</span></label>
	<div class="col-md-9">
		<input type="number" class="form-control" name="pass_mark" id="pass_mark" required title="Must Be Required"/>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Subject Type <span class="required">*</span></label>
	<div class="col-md-9">
		<select name="subject_type" class="form-control populate" data-plugin-selectTwo data-width="100%" required title = "Value Required"data-minimum-results-for-search="Infinity" >
			<option value="Theory">Theory</option>
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
			<option value="1">One</option>
		</select>
	</div>
</div>

<div class="form-group mb-md">
	<label class="col-md-3 control-label">Teacher <span class="required">*</span></label>
	<div class="col-md-9">
		<select name="teacher_id" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate"
		required title="Must Be Required">
			<option value="">Select Teacher</option>
			<option value="1">Anzo Perez</option>
			<option value="2">Johanna Luisa</option>
		</select>
	</div>
</div>

</div>
<footer class="panel-footer">
	<div class="text-right">
		<button type="submit" class="btn btn-primary">Save</button>
		<button class="btn btn-default modal-dismiss">Cancel</button>
	</div>
</footer>
</form>
</section>
</div>
</div>
</div>';
