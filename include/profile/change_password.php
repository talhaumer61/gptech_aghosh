<?php
echo '
<div id="resetpass" class="tab-pane">
	<form action="#" class="form-horizontal validate" method="post" accept-charset="utf-8">
		<fieldset class="mt-lg">
			<div class="form-group">
				<label class="col-sm-3 control-label">New Password <span class="required">*</span></label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="pass" required title="Must Be Required" name="new_password" value=""/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-sm-3 control-label">Confirm New Password <span class="required">*</span></label>
				<div class="col-sm-8">
					<input type="password" class="form-control"  name="cnfrm_pass" required title="Must Be Required" name="confirm_new_password" value=""/>
				</div>
			</div>
		</fieldset>
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" name="chnage_pass" class="btn btn-primary">Change Password</button>
				</div>
			</div>
		</div>
	</form>
</div>';
?>