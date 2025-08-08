<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINIDA'] == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || ($_SESSION['userlogininfo']['LOGINIDA'] == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '64', 'added' => '1')))
{
echo'
<!-- Add Modal Box -->
<div id="inquiry_followup" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="admission_inquiryfollowup.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Inquiry Followup</h2>
			</header>
			<div class="panel-body">
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Inquiry <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_inquiry">
							<option value="">Select</option>';
								$sqllmscls	= $dblms->querylms("SELECT id, name 
													FROM ".ADMISSIONS_INQUIRY."
													WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' 
													ORDER BY name ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
						if($valuecls['id'] == $rowsvalues['id_inquiry']) { 
							echo '<option value="'.$valuecls['id'].'" selected>'.$valuecls['name'].'</option>';
						} else { 
							echo '<option value="'.$valuecls['id'].'">'.$valuecls['name'].'</option>';
						}
					}
						echo '
						</select>
					</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Date Followup <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="datefollowup" id="datefollowup" data-plugin-datepicker required required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Next Followupdate <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="next_followupdae" id="next_followupdae" data-plugin-datepicker required required title="Must Be Required" />
				</div>
			</div>

			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Response <span class="required">*</span></label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="response" id="response" required title="Must Be Required"  />
				</div>
			</div>
			
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Note <span class="required">*</span></label>
				<div class="col-md-9">
					<textarea type="text" class="form-control" name="note" id="note" required title="Must Be Required"  ></textarea>
				</div>
			</div>
			
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" id="submit_inquiryfollowup" name="submit_inquiryfollowup">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>';
}
?>