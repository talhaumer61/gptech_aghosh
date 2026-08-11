<?php 
//---------------------------------------------------------
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
//--------------------------------------------------------
if(($_SESSION['userlogininfo']['LOGINTYPE']  == 1) || ($_SESSION['userlogininfo']['LOGINTYPE']  == 2) || Stdlib_Array::multiSearch($_SESSION['userroles'], array('right_name' => '75', 'edit' => '1'))){ 
//---------------------------------------------------------
	$sqllms	= $dblms->querylms("SELECT  s.id, s.status, s.consession_on, s.percent, s.amount, s.id_cat, s.id_std, s.id_session, s.note, st.id_class
								   FROM ".SCHOLARSHIP." s
								   INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std
								   WHERE s.id = '".cleanvars($_GET['id'])."' LIMIT 1");
	$rowvalues = mysqli_fetch_array($sqllms);
//--------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary">
	<form action="feeconcession.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fee Concession</h2>
		</header>
		<div class="panel-body">
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Category <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat" onchange="getConcessionCatDetail(this.value)">
							<option value="">Select</option>';
								$sqllms	= $dblms->querylms("SELECT cat_id, cat_type, cat_status, cat_name 
													FROM ".SCHOLARSHIP_CAT."
													WHERE cat_id != '' AND cat_status = '1' AND cat_type = '2' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
													ORDER BY cat_name ASC");
								while($values = mysqli_fetch_array($sqllms)) {
									if($values['cat_id'] == $rowvalues['id_cat']) { 
										echo '<option value="'.$values['cat_id'].'" selected>'.$values['cat_name'].'</option>';
									} else { 
										echo '<option value="'.$values['cat_id'].'">'.$values['cat_name'].'</option>';
									}
									}
							echo '
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Class <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_class" name="id_class" onchange="get_classstudent(this.value)" disabled>
							<option value="">Select</option>';
							$sqllmsclass	= $dblms->querylms("SELECT class_id, class_name 
																	FROM ".CLASSES." 
																	WHERE class_status = '1' ORDER BY class_id ASC");
							while($value_class 	= mysqli_fetch_array($sqllmsclass)) {
								if($value_class['class_id'] == $rowvalues['id_class']){
									echo '<option value="'.$value_class['class_id'].'" selected>'.$value_class['class_name'].'</option>';
								}
							}
							echo '
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-xs">
					<div class="col-md-12">
						<label class="control-label">Student <span class="required">*</span></label>
						<div id="getclassstudent">
							<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_std" disabled>
								<option value="">Select</option>';
									$sqllms	= $dblms->querylms("SELECT std_id, std_status, std_name, std_fathername, id_campus
														FROM ".STUDENTS."
														WHERE std_id != '' AND std_status = '1' AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
														ORDER BY std_name ASC");
									while($values = mysqli_fetch_array($sqllms)) {
										if($values['std_id'] == $rowvalues['id_std']) { 
											echo '<option value="'.$values['std_id'].'" selected>'.$values['std_name'].' '.$values['std_fathername'].'</option>';
										} 
										}
								echo '
							</select>
						</div>
					</div>
				</div>
			</div>';
			
			//------------------------------------------------
			$sqllmsCats  = $dblms->querylms("SELECT cat_id, cat_name  
												FROM ".FEE_CATEGORY."
												WHERE cat_status = '1' 
												AND cat_id NOT IN(13, 14, 16, 17)
												ORDER BY cat_ordering ASC");
			if(mysqli_num_rows($sqllmsCats) >0) {
				$tot_amount = 0;
				while($valCat = mysqli_fetch_array($sqllmsCats)) {

					//------------------------------------------------
					$sqllmsDet	= $dblms->querylms("SELECT det_id, amount
													FROM ".SCH_CONCESS_DET."
													WHERE id_setup = '".cleanvars($_GET['id'])."'
													AND id_cat = '".cleanvars($valCat['cat_id'])."' LIMIT 1");
					$valDet = mysqli_fetch_array($sqllmsDet);
					//------------------------------------------------
					echo'
					<div class="col-md-4">
						<div class="form-group mt-sm">
							<div class="col-md-12">
								<label class=control-label">'.$valCat['cat_name'].'</label>
								<input type="hidden" name="fee_cat[]" value="'.$valCat['cat_id'].'">
								<input type="number" id="cat_amount" name="cat_amount[]" value="'.$valDet['amount'].'" class="form-control cats" class="form-control cats"'; if($valCat['cat_id'] == 2){echo'required title="Must Be Required"';} echo'/>
							</div>
						</div>
					</div>';
					$tot_amount = $tot_amount + $valDet['amount'];
				}
			}
			//------------------------------------------------

			echo'
			<div style="clear:both;"></div> 
			
			<div class="col-md-12">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label">Total Amount <span class="required">*</span></label>
						<input type="text" id="total_amount" name="total_amount" value="'.$tot_amount.'" class="form-control total" required title="Must Be Required" readonly/>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label">Note </label>
						<textarea class="form-control" rows="2" name="note" id="note">'.$rowvalues['note'].'</textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Status <span class="required">*</span></label>
				<div class="col-md-9">
					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="1"'; if($rowvalues['status'] == 1) {echo' checked';}echo'>
						<label for="radioExample1">Active</label>
					</div>

					<div class="radio-custom radio-inline">
						<input type="radio" id="status" name="status" value="2"'; if($rowvalues['status'] == 2) {echo' checked';}echo'>
						<label for="radioExample2">Inactive</label>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="submit" class="btn btn-primary" id="changes_feeconcession" name="changes_feeconcession">Update</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</form>
</section>
</div>
</div>';
}
?>

<script type="text/javascript">
	$(document).on("change", ".cats", function() {
		var sum = 0;
		$(".cats").each(function(){
			sum += +$(this).val();
		});
		$(".total").val(sum);
	});
</script>