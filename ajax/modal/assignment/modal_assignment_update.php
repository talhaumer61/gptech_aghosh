
<script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/user_config/forms_validation.js"></script><script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="http://pvssystem.com/rudras_school_demo/suggestion/maintain/update/1" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-heading">
				<h2 class="panel-title">
                    <i class="glyphicon glyphicon-edit"></i>
                    Edit Assignment                </h2>
			</div>
			
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Title <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="title" value="Research Web Design" required title="Must Be Required"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" name="class_id" id="class_id" required
						title="Must Be Required" onchange="return get_class_subject(this.value)">
							<option value="">Select</option>
														<option value="1" selected>One</option>
													</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">
						Subject <span class="required">*</span>
					</label>
					<div class="col-md-9">
						<select name="subject_id" class="form-control" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" id="subject_selector_holder"
						required title="Must Be Required">
														<option value="1" >English</option>
														<option value="2" >Bangla</option>
														<option value="3" selected>Computer</option>
														<option value="4" >Mathematics</option>
													</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Description</label>
					<div class="col-md-9">
						<textarea class="form-control" name="description">Do a research paper on web design and come up with a mockup yourself based on work done in class </textarea>
					</div>
				</div>
				
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Date Of Publish <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" value="09/07/2017" class="form-control" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' name="date"
						required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">File Upload <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="input-append">
								<div class="uneditable-input" style="width: 60%">
									<i class="fa fa-file fileupload-exists"></i>
									<span class="fileupload-preview"></span>
								</div>
								<span class="btn btn-default btn-file">
								<span class="fileupload-exists">Change</span>
								<span class="fileupload-new">Select file</span>
								<input type="file" name="userfile"/>
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
						<button type="submit" class="btn btn-primary">Update</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
			</form>		</section>
	</div>
</div>
<script type="text/javascript">
	function get_class_subject( class_id ) {
		$.ajax( {
			url: 'http://pvssystem.com/rudras_school_demo/suggestion/get_subject/' + class_id,
			success: function ( response ) {
				jQuery( '#subject_selector_holder' ).html( response );
			}
		} );

	}
</script>