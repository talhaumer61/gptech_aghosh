<?php 
echo '
<!-- Add Modal Box -->
<div id="make_behaviour" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="student_behaviour.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Behaviour</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Student <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT std_id, std_firstname, std_lastname
													FROM ".STUDENTS."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND std_status = '1'  
													ORDER BY std_firstname ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['std_id'].'">'.$valuecls['std_firstname'].' '.$valuecls['std_lastname'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Role <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_role">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT role_id, role_status, role_name
													FROM ".BEHAVIOUR_ROLES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."'
													AND role_status = '1' 
													ORDER BY role_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['role_id'].'">'.$valuecls['role_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="dated" id="dated" data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
				<div class="form-group mb-md">
					<label class="col-md-3 control-label">Report</label>
					<div class="col-md-9">
						<textarea class="form-control" rows="2" name="report" id="report"></textarea>
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
						<button type="submit" class="btn btn-primary" id="submit_behaviour" name="submit_behaviour">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';