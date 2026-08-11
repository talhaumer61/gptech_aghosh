
<script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/user_config/forms_validation.js"></script><script src="http://pvssystem.com/rudras_school_demo/assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="http://pvssystem.com/rudras_school_demo/classes/sections/update/1" class="form-horizontal" id="form" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Section				</h4>
			</div>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="name" required title="Must Be Required" value="A"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Maximum Students</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="capacity" value="" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select name="class_id" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" required title="Must Be Required">
							<option value="">Select</option>
														<option value="1" selected>One</option>
													</select>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Teacher</label>
					<div class="col-md-9">
						<select name="teacher_id" class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity">
							<option value="">Select</option>
														<option value="1" selected>Anzo Perez</option>
														<option value="2" >Johanna Luisa</option>
													</select>
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
