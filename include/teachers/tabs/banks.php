<?php 
echo '
<div id="bank" class="tab-pane ">
<section class="panel panel-pvs-shadow mt-lg">
	<header class="panel-heading panel-featured-primary pvs-heading-tran">
		<div class="pull-right">
			<a href="#add_bank" class="modal-with-move-anim btn btn-xs btn-primary"><i class="fa fa-plus-square"></i> Add Bank</a>
		</div>
		<h2 class="panel-title">List Of Bank Details</h2>
	</header>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped mb-none">
				<thead>
					<tr>
						<th>#</th>
						<th>Bank Name</th>
						<th>Account Name</th>
						<th>Branch</th>
						<th>Bank Address</th>
						<th>IFSC Code</th>
						<th>Account No</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>ISBI</td>
						<td>Ani Roy</td>
						<td>Kolkata</td>
						<td>Thakurnagar-140</td>
						<td>120555444</td>
						<td>187455544</td>
						<td>
						<!-- UPDATE LINK -->
							<a href="#bank_edit21" class="modal-with-move-anim-pvs btn btn-xs btn-primary">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
<div id="bank_edit21" class="mfp-with-anim modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form role="form" action="#" method="post" class="validate">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Bank Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="bank_name" value="ISBI" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Account Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="account_name" value="Ani Roy" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Branch <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="branch" value="Kolkata" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Bank Address</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="bank_address" value="Thakurnagar-140" />
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">IFSC Code <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="ifsc_code" value="120555444" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Account No <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="account_no" value="187455544" required title="Must Be Required"/>
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
		</form>
	</section>
</div>
						<!-- DELETION LINK -->
							<a href="#" class="btn btn-xs btn-danger" onclick="confirm_modal(\'teacher/bank_info/delete/21\');">
								<i class="el el-trash"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
</div>';
include_once("include/teachers/modal/modal_bank_add.php");