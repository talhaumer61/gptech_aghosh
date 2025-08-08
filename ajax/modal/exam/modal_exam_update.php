
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam/maintain/update/2" class="form-horizontal" id="form" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Exam				</h4>
			</div>

			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-sm-3 control-label">Name <span class="required">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="name"  value="HSC" required title = "Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Term</label>
					<div class="col-sm-9">
					<select name="term_id" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" class="form-control populate" >
						<option value="">Select</option>
												<option value="1" >First</option>
												<option value="2" >Second</option>
											</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Date  <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="input-daterange input-group" data-plugin-datepicker>
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<input type="text" class="form-control" name="start_date" required title="Must Be Required" value="07/22/2017">
							<span class="input-group-addon">to</span>
							<input type="text" class="form-control" name="end_date" required title="Must Be Required" value="07/30/2017">
						</div>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-sm-3 control-label">Comment</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="comment" value=""/>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</footer>
			</form>		</section>
	</div>
</div>