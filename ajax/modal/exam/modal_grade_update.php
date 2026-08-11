
<script src="assets/javascripts/user_config/forms_validation.js"></script><script src="assets/javascripts/theme.init.js"></script><div class="row">
	<div class="col-md-12">
		<section class="panel panel-featured panel-featured-primary">
			<form action="exam/grade/update/3" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">

			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="glyphicon glyphicon-edit"></i>
					Edit Grade				</h4>
			</div>

			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-sm-4 control-label">Name <span class="required">*</span></label>
					<div class="col-sm-8 controls">
						<input type="text" class="form-control" name="name" required title="Must Be Required" value="A-"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Grade Point <span class="required">*</span></label>
					<div class="col-sm-8 controls">
						<input type="number" class="form-control" name="grade_point" required title="Must Be Required" value="3.5"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Lower Mark Range <span class="required">*</span></label>
					<div class="col-sm-8 controls">
						<input type="number" class="form-control" name="lower_mark"  required title="Must Be Required" value="60"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Upper Mark Range <span class="required">*</span></label>
					<div class="col-sm-8 controls">
						<input type="number" class="form-control" name="upper_mark" required title="Must Be Required" value="69"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-sm-4 control-label">Comment</label>
					<div class="col-sm-8 controls">
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




