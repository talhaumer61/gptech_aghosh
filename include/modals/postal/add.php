<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '69', 'added' => '1')))
{
echo '
<!-- Add Modal Box -->
<div id="make_postal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="postal_receive.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make postal</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">From Title<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="from_title" id="from_title" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">From Phone<span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "from_phone" id="from_phone">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">From Email<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="from_email" id="from_email" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Reference No<span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "reference_no" id="reference_no">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Address<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="address" id="address" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Note<span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "note" id="note">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">To Title<span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "to_title" id="to_title">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Dated<span class="required">*</span></label>
					<div class="col-md-9">
						<input type = "text" class="form-control"  name= "dated" id="dated">
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Attachment<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="attachment" id="attachment" required title="Must Be Required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_postal" name="submit_postal">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>