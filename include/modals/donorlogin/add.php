<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '88', 'add' => '1'))){ 
echo '
<!-- Add Modal Box -->
<div id="make_donorlogin" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="donorLogin.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i> Make Donor Login</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Donor <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_donor" name="id_donor" onchange="get_donordetail(this.value)">
							<option value="">Select</option>';
							$sqllmsDonor = $dblms->querylms("SELECT donor_id, donor_name 
																	FROM ".DONORS." 
																	WHERE donor_status = '1' ORDER BY donor_id ASC");
							while($valueDonor = mysqli_fetch_array($sqllmsDonor)) {
								echo '<option value="'.$valueDonor['donor_id'].'">'.$valueDonor['donor_name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				<div id="getdonordetail">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Full Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="adm_fullname" name="adm_fullname" required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Phone </label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="adm_phone" name="adm_phone"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Email </label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="adm_email" name="adm_email"/>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Username <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="adm_username" name="adm_username" required title="Must Be Required"/>
					</div>
				</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label"> Password <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="password" class="form-control" id="adm_userpass" name="adm_userpass" required title="Must Be Required"/>
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
						<button type="submit" class="btn btn-primary" id="submitDonor" name="submitDonor">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>