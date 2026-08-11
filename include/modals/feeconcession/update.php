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
	
// Get all Student
	$conditions = array ( 
								  'select' 		=> 's.*, st.std_id, st.std_name, st.std_fathername, st.std_regno,
								  					st.id_class, cl.class_name, se.session_id, se.session_name'
								, 'join' 		=> "INNER JOIN ".STUDENTS." st ON st.std_id = s.id_std 
													INNER JOIN ".CLASSES." cl ON cl.class_id = s.id_class  
													INNER JOIN ".SESSIONS." se ON se.session_id = s.id_session"
								, 'where' 		=> array( 
															  'st.id_campus' => $_SESSION['userlogininfo']['LOGINCAMPUS']
															, 's.id' 	 	=> $_GET['id']
															, 's.id_session' => $_SESSION['userlogininfo']['ACADEMICSESSION']
															, 's.is_deleted' => 0 
														) 
								, 'limit' 		=> 1
								, 'return_type' => 'single' 
							); 
	$rowvalues 	= $dblms->getRows(SCHOLARSHIP.' s ', $conditions);
//--------------------------------------
echo '
<script src="assets/javascripts/user_config/forms_validation.js"></script>
<script src="assets/javascripts/theme.init.js"></script>
<div class="row">
<div class="col-md-12">
<section class="panel panel-featured panel-featured-primary" >
	<form action="feeconcession.php" class="form-horizontal" id="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off">
	<input type="hidden" name="id" id="id" value="'.cleanvars($_GET['id']).'">
		<header class="panel-heading">
			<h2 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Edit Fee Concession</h2>
		</header>
		<div class="panel-body">
			
			<div class="col-md-3">
				<div class="form-group mt-sm">
					<div class="col-md-12">
				
						<label class="control-label" style="font-weight:600;color:#333;"> Date <span class="required">*</span></label>
						<input type="date" class="form-control" required title="Must Be Required" name="date" value="'.$rowvalues['date'].'" id="date" autocomplete="off"/>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label" style="font-weight:600;color:#333;">Class Name <span class="required">*</span></label>
						<input type="text" class="form-control" required name="class_name" id="class_name" value="'.$rowvalues['class_name'].'" readonly/>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label" style="font-weight:600;color:#333;">Student Name <span class="required">*</span></label>
						<input type="text" class="form-control" required name="std_name" id="std_name" value="'.$rowvalues['std_name'].' ('.$rowvalues['std_regno'].')" readonly/>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label" style="font-weight:600;color:#333;">Concession Category <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="id_cat" id="id_cat">
							<option value="">Select</option>';
								$sqllmscats	= $dblms->querylms("SELECT cat_id, cat_type, cat_status, cat_name 
																FROM ".SCHOLARSHIP_CAT."
																WHERE cat_id != '' AND cat_status = '1' AND cat_type = '2' 
																AND id_campus = '".cleanvars($_SESSION['userlogininfo']['LOGINCAMPUS'])."'
																ORDER BY cat_name ASC");
								while($rowcats = mysqli_fetch_array($sqllmscats)) {
									echo ($rowvalues['id_cat'] == $rowcats['cat_id']) ? '<option value="'.$rowcats['cat_id'].'" selected>'.$rowcats['cat_name'].'</option>' : '<option value="'.$rowcats['cat_id'].'">'.$rowcats['cat_name'].'</option>';
								}
							echo '
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label" style="font-weight:600;color:#333;">Authority <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_authority" name="id_authority">
						<option value="">Select</option>';
							foreach($authority as $listauthority) {
								echo ($rowvalues['id_authority'] == $listauthority['id']) ? '<option value="'.$listauthority['id'].'" selected>'.$listauthority['name'].'</option>' : '<option value="'.$listauthority['id'].'">'.$listauthority['name'].'</option>';
							}
						echo '
					</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mt-sm">
					<div class="col-md-12">
						<label class="control-label" style="font-weight:600;color:#333;">Concession Head <span class="required">*</span></label>
						<select class="form-control" required title="Must Be Required" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" id="id_feecat" name="id_feecat" >
						<option value="">Select</option>';
				$sqllmsheads  = $dblms->querylms("SELECT cat_id, cat_name  
														FROM ".FEE_CATEGORY."
														WHERE cat_status = '1' 
														AND cat_isdiscounted = '1'
														ORDER BY cat_ordering ASC");

				while($rowheads = mysqli_fetch_array($sqllmsheads)) {
					echo ($rowvalues['id_feecat'] == $rowheads['cat_id']) ? '<option value="'.$rowheads['cat_id'].'" selected>'.$rowheads['cat_name'].'</option>' : '<option value="'.$rowheads['cat_id'].'">'.$rowheads['cat_name'].'</option>';
				}
			echo '
				</select>
					</div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group mt-sm">
					<div class="col-md-12">
					<label class="control-label" style="font-weight:600;color:#333;">Amount <span class="required">*</span></label>
					<input type="number" class="form-control" required title="Must Be Required" name="amount" value="'.$rowvalues['amount'].'" id="amount" autocomplete="off"/>
					</div>
				</div>
			</div> 
			<div style="clear:both;"></div> 
			
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