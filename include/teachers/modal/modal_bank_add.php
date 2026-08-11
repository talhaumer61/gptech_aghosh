<?php 
echo '
<div id="add_bank" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal validate" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Add Bank</h2>
			</div>
			<div class="panel-body">
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Bank Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="bank_name" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Account Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_name" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Branch <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="branch" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Bank Address</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="bank_address" />
				</div>
			</div>
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">IFSC Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="ifsc_code" required title="Must Be Required"/>
				</div>
			</div>
			<div class="form-group mb-md">
				<label class="col-md-3 control-label">Account No <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="account_no" required title="Must Be Required"/>
				</div>
			</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';