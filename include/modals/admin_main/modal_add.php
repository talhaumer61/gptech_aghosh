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
					<label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_fullname" id="adm_fullname" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Email </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_email" id="adm_email"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Phone </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_phone" id="adm_phone"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">User Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_username" id="adm_username" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Password <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="adm_userpass" id="adm_userpass" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Type <span class="required">*</span></label>
					<div class="col-md-9">
						<select name="adm_type" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required" >
						<option value="">Select Type</option>';
								foreach($admtypes as $itemadmtypes) {
								echo '<option value="'.$itemadmtypes['id'].'">'.$itemadmtypes['name'].'</option>';
								}
		echo '			</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Campus <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_campus"> 
						<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT campus_id, campus_status, campus_name 
																										FROM ".CAMPUS." 
																										WHERE campus_status = '1'
																										ORDER BY campus_name ASC");
														while($valuecls = mysqli_fetch_array($sqllmscls)) {
																echo '<option value="'.$valuecls['campus_id'].'">'.$valuecls['campus_name'].'</option>';
														}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="adm_status" name="adm_status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="adm_status" name="adm_status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_adm" name="submit_adm">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';