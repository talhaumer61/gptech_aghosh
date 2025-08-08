<?php 
echo '
<!-- Add Modal Box -->
<div id="make_assignment" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Assignment</h2>
			</header>
			<div class="panel-body">
				
			<div class="form-group">
				<label class="col-md-3 control-label">Title <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="assig_title" id="assig_title" required title="Must Be Required">
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Open <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="input-daterange input-group" data-plugin-datepicker>
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<input type="text" class="form-control valid" name="open_date" id="open_date" required="" title="Must Be Required" aria-required="true" aria-invalid="false">
						<span class="input-group-addon">Due </span>
						<input type="text" class="form-control" name="close_date" id="close_date" required="" title="Must Be Required"  aria-required="true">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">File </label>
				<div class="col-md-9">
					<input type="file" class="form-control" name="assig_file" id="assig_file"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Note </label>
				<div class="col-md-9">
					<textarea class="form-control" rows="2" name="assig_note" id="assig_note"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="assig_status" name="assig_status" value="1" checked>
						<label for="radioExample1">Active</label>
					</div>
					<div class="radio-custom radio-inline">
						<input type="radio" id="assig_status" name="assig_status" value="2">
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_assignment" name="submit_assignment">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>