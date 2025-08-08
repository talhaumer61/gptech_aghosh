<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '26', 'added' => '1'))){ 
echo '
<!-- Add Campus Box -->
<div id="make_campus" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Campus </h2>
			</header>

			<div class="panel-body">

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Registration # <span class="required">*</span></label>
				<div class="col-md-9">
						<input type="text" class="form-control" name="campus_regno" id="campus_regno" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Code <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_code" id="campus_code" required title="Must Be Required"/>
					</div>
				</div>


				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Name <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_name" id="campus_name" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Address <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea class="form-control" rows="3" name= "campus_address" id="campus_address"></textarea>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Campus Head <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="campus_head" id="campus_head" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> E-mail <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="campus_email" id="campus_email" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Phone <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="campus_phone" id="campus_phone" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Fax </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="campus_fax" id="campus_fax"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Website </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="campus_website" id="campus_website"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"> Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="campus_status" name="campus_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="campus_status" name="campus_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_campus" name="submit_campus">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>