<?php 
echo '
<div id="resetpass" class="tab-pane">
	<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<fieldset class="mb-xl mt-lg">
			<div class="form-group">
				<label class="col-sm-3 control-label">
					New Password <span class="required">*</span>
				</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="new_password"  required title = "Must Be Required" value=""/>
				</div>
			</div>
	
			<div class="form-group">
				<label class="col-sm-3 control-label">
					Confirm New Password <span class="required">*</span>
				</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="confirm_new_password"  required title = "Must Be Required" value=""/>
				</div>
			</div>
		</fieldset>
		<div class="panel-footer">
			<div class="row">	
				<div class="col-md-9 col-md-offset-3">
					<button type="submit" class="btn btn-primary">Password Update</button>
				</div>
			</div>	
		</div>
	</form>
</div>';