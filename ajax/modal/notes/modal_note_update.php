
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
			<div class="panel panel-featured panel-featured-primary">
			<form action="content/maintain/update/1" class="form-horizontal mb-lg" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-heading">
				<h2 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i> Update Teacher Note				</h2>
			</div>

			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-sm-3 control-label">Title <span class="required">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="name" class="form-control" value="grsce" required title="Must Be Required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Class <span class="required">*</span></label>
					<div class="col-sm-9">
						<select name="class_id" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity"
						required title="Must Be Required">
							<option value="">Select</option>
															<option value="1" selected>One</option>
													</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Description</label>
					<div class="col-sm-9">
						<textarea name="description" class="form-control">bisnis vnivivnernaqon  AOGOSAGASGOPAN AOSNGOASNSAA onasnoanoa onaoAOANGA</textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Date Of Publish <span class="required">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" value="09/08/2017" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' 
						name="timestamp" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">File Upload <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="input-append">
								<div class="uneditable-input" style="width: 62%">
									<i class="fa fa-file fileupload-exists"></i>
									<span class="fileupload-preview"></span>
								</div>
								<span class="btn btn-default btn-file">
									<span class="fileupload-exists">Change</span>

								<span class="fileupload-new">Select file</span>
								<input type="file" name="file_name"/>
								</span>
								<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary modal-confirm">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
		</div>
	 
	</div>
</div>