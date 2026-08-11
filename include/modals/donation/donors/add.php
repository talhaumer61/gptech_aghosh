<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '79', 'add' => '1'))){
echo'
<!-- Add Modal Box -->
<div id="make_class" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="donors.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Donor</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="donor_name" id="donor_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Cnic <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name = "donor_cnic" id="donor_cnic" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name = "donor_phone" id="donor_phone" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Whatsapp <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="number" class="form-control" name = "donor_whatsapp" id="donor_whatsapp" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Email <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="email" class="form-control" name="donor_email" id="donor_email" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Country </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="country" id="country">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">City </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="class_code" id="class_code">
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Address <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="donor_address" id="donor_address" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="donor_status" name="donor_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="donor_status" name="donor_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_donor" name="submit_donor">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>