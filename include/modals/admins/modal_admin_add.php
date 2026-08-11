<?php 
echo '
<!-- Add Modal Box -->
<div id="make_admin" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="#" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Admin</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Admin Type <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_type" id="adm_type" required title="Must Be Required"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Admin Username<span class="required">*</span></label>
					<div class="col-md-9">
						<input class="form-control" rows="3" name= "adm_username" id="adm_username" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Admin Userpass<span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_userpass" id="adm_userpass" required title="Must Be Required" />
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Admin Name</label>
					<div class="col-md-9">
						<input class="form-control" rows="2" name = "adm_fullname" required title="Must Be Required"/>
					</div>
				</div>


				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Admin Email</label>
					<div class="col-md-9">
						<input class="form-control" rows="2" name = "admnemail" id="admnemail"required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Admin Phone</label>
					<div class="col-md-9">
						<input class="form-control" rows="2" name = "adm_phone" id="adm_phone"required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Admin Photo</label>
					<div class="col-md-9">
						<input class="form-control" rows="2" name = "adm_photo" id="adm_photo"required title="Must Be Required"/>
					</div>
				</div>



				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
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
						<button type="submit" class="btn btn-primary" id="submit_admin" name="submit_admin">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';


?>