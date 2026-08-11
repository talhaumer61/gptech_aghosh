<?php 
echo '
<div class="panel panel-featured panel-featured-primary" >
	<form action="#" class="form-horizontal form-bordered" target="_top" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="panel-heading">
			<h4 class="panel-title">Upload Logo</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">Photo</label>
				<div class="col-sm-9">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
							<img src="uploads/logo.png" alt="...">
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
		<footer class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</div>
		</footer>
	</form>
</div>';