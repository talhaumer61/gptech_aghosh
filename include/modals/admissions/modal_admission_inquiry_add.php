<?php 
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '49', 'add' => '1')))
{	
//----------------------------------------------------
$sqllmscampus  = $dblms->querylms("SELECT campus_code
									FROM ".CAMPUS." 
									WHERE campus_status = '1' AND campus_id = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."' LIMIT 1");
$value_campus = mysqli_fetch_array($sqllmscampus);
//-----------------------------------------------------

//-----------------------------------------------------
$sqllms	= $dblms->querylms("SELECT MAX(id) as form
								   FROM ".ADMISSIONS_INQUIRY." 
								   WHERE id_campus = '".$_SESSION['userlogininfo']['LOGINCAMPUS']."' ");
//-----------------------------------------------------
$rowsvalues = mysqli_fetch_array($sqllms);
$form_no = $rowsvalues['form'] + 1;
//-----------------------------------------------------
echo'
<!-- Add Modal Box -->
<div id="admission_inquiry" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel panel-featured panel-featured-primary">
		<form action="admission_inquiry.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<header class="panel-heading">
				<h2 class="panel-title"><i class="fa fa-plus-square"></i>  Make Admission Inquiry</h2>
			</header>
			<div class="panel-body">
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Form Number <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="form_no" id="form_no" value="'.$value_campus['campus_code'].'-'.$form_no.'" required title="Must Be Required" autocomplete="off" readonly/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Session <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" name="id_session">
							<option value="">Select</option>';
							$sqllmscls	= $dblms->querylms("SELECT session_id, session_name 
														FROM ".SESSIONS."
														WHERE session_id != '' AND is_deleted != '1'
														ORDER BY session_id DESC");
							while($valuecls = mysqli_fetch_array($sqllmscls)) {
								echo '<option value="'.$valuecls['session_id'].'" '.($valuecls['session_id'] == '4' ? 'selected' : '').'>'.$valuecls['session_name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="name" id="name" required title="Must Be Required" autocomplete="off"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Father Name <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="fathername" id="fathername" required title="Must Be Required" autocomplete="off"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Gender <span class="required">*</span></label>
					<div class="col-md-9">
						<select id="gender" name="gender" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
							<option value="">-- Select --</option>
							<option value="Male" >Male</option>
							<option value="Female" >Female</option>
						</select>
					</div>
				</div>
							
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Whatsapp <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="cell_no" id="cell_no" required title="Must Be Required" autocomplete="off"/>
					</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Father CNIC <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="cnicno" id="cnicno" required title="Must Be Required" autocomplete="off"/>
					</div>
				</div>
				
				
			<div class="form-group mt-sm">
				<label class="col-md-3 control-label">Email Address</label>
				<div class="col-md-9">
					<input type="email" class="form-control" name="emailaddress" id="emailaddress" autocomplete="off" value=""  />
				</div>
			</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Address <span class="required">*</span></label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="address" id="address" required title="Must Be Required"></textarea>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Previous Class </label>
					<div class="col-md-9">
						<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_previousclass">
							<option value="">-- Select --</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES."
																	WHERE class_status = '1' ORDER BY class_id ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Previous School </label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="school" id="school" autocomplete="off"/>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Inquiry for Class <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class">
							<option value="">-- Select --</option>';
								$sqllmscls	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES."
																	WHERE class_status = '1' ORDER BY class_id ASC");
								while($valuecls = mysqli_fetch_array($sqllmscls)) {
							echo '<option value="'.$valuecls['class_id'].'">'.$valuecls['class_name'].'</option>';
							}
						echo '
						</select>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Is Orphan <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="is_orphan">
							<option value="">-- Select --</option>';
							foreach($statusyesno as $stat){
								echo '<option value="'.$stat['id'].'"'; if($stat['id'] == '2'){echo'selected';} echo'>'.$stat['name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Is Hostelized <span class="required">*</span></label>
					<div class="col-md-9">
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="is_hostelized">
							<option value="">-- Select --</option>';
							foreach($statusyesno as $stat){
								echo '<option value="'.$stat['id'].'"'; if($stat['id'] == '2'){echo'selected';} echo'>'.$stat['name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Source <span class="required">*</span></label>
					<div class="col-md-9">
						<select id="source" name="source" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
							<option value="">-- Select --</option>';
							foreach($inquirysrc as $source){
							echo '<option value="'.$source['id'].'">'.$source['name'].'</option>';
							}
							echo '
						</select>
					</div>
				</div>
				
				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Inquiry Month <span class="required">*</span></label>
					<div class="col-md-9">
						<input type="month" class="form-control" name="yearmonth" id="yearmonth" value=""  required title="Must Be Required"/>
						<!--
						<select id="id_month" name="id_month" data-plugin-selectTwo data-minimum-results-for-search="Infinity" data-width="100%" class="form-control populate" required title="Must Be Required">
							<option value="">-- Select --</option>';
							foreach($monthtypes as $month):
								echo '<option value="'.$month['id'].'">'.$month['name'].'</option>';
							endforeach;
							echo '
						</select>
						-->
					</div>
				</div>

				<div class="form-group mt-sm">
					<label class="col-md-3 control-label">Note </label>
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="note" id="note" autocomplete="off"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Genrate Challan <span class="required">*</span></label>
					<div class="col-md-9">
						<div class="radio-custom radio-inline">
							<input type="radio" id="genrateChallan" name="genrateChallan" value="1" checked>
							<label for="radioExample1">Yes</label>
						</div>
						<div class="radio-custom radio-inline">
							<input type="radio" id="genrateChallan" name="genrateChallan" value="2">
							<label for="radioExample2">No</label>
						</div>
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
						<button type="submit" class="btn btn-primary" id="submit_inquiry" name="submit_inquiry">Save</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</form>
	</section>
</div>
<script src="assets/javascripts/jquery.maskedinput.min.js"></script>
<script>
	jQuery(function($) {
      $.mask.definitions["~"]="[+-]";
      $("#cnicno").mask("99999-9999999-9");
	  $("#cell_no").mask("9999-9999999");
	
        });
</script>';
}
?>
