<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) ||($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '42', 'added' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_shop" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="stationary.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Store</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Store Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="store_name" id="store_name" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Store Code <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="store_code" id="store_code" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Store Detail</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name = "store_detail" id="store_detail"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="store_status" name="store_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="store_status" name="store_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_shop" name="submit_shop">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>