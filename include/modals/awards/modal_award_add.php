<?php
echo'
<!-- Add Award Box -->
<div id="make_award" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="awards.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Award</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Award Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="award_name" id="award_name" required title="Must Be Required"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Gift Item <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="gift_item" id="gift_item" required title="Must Be Required"/>
					</div>
				</div>


				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Cash Price <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="cash_price" id="cash_price" required title="Must Be Required"/>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-md-3 control-label">Award Reason <span class="required">*</span></label>
					<div class="col-md-9">
						<input class="form-control" rows="3" name="award_reason" id="award_reason"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Given Date <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="given_date" id="given_date" data-plugin-datepicker required title="Must Be Required"/>
					</div>
				</div>
				

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
													FROM ".CLASSES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND class_status = '1'
													ORDER BY class_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>
				
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
					<label class="col-md-3 control-label">Given By <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="given_by">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT emply_id, emply_name 
													FROM ".EMPLOYEES."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													AND emply_status = '1'
													ORDER BY emply_name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['emply_id'].'">'.$valuecls['emply_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="award_status" name="status" value="1" checked>
							<label for="radioExample1">Active</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="award_status" name="status" value="2">
							<label for="radioExample2">Inactive</label>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_award" name="submit_award">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
?>